<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Location;
use App\Models\Paiement;
use Illuminate\Validation\Rule;

class PaiementLive extends Component
{

    public Location $location ; //On a besoin de l'location à tarifier

    public $newPaiement = [] ; //Un tableau qui stock les valeurs de Paiement

    public $addPaiement = false ; //Permet d'ajouter une Paiement

    //Renvoie l'identifiant en parametre
    public function mount($locationId){
        $this->location = Location::find($locationId);
    }

    public function render()
    {
        return view('livewire.paiements.index', [
            "paiements" => Paiement::with(["user"])->whereLocationId($this->location->id)->get(), "users" =>  User::all()
        ])
                ->extends("layouts.master")
                ->section("content");
    }

    public function newPaiement(){
        $this->addPaiement = true;
    }

    public function editPaiement(Paiement $paiement){
        $this->addPaiement = true;
        $this->newPaiement = $paiement->toArray();
        $this->newPaiement["edit"] = true;
    }
    public function savePaiement(){

        $locationId = $this->location->id;
        $newPaiement = $this->newPaiement;

        $uniqueRole = function() use($newPaiement,$locationId){

            return (isset($newPaiement["edit"])) ?

            Rule::unique((new Paiement())->getTable() , "user_id")
                ->ignore($newPaiement["id"] , "id")
                ->where(function($query) use ($locationId){
                    return $query->where("location_id", $locationId);
                })
                :
                Rule::unique((new Paiement())->getTable() , "user_id")
                ->where(function($query) use ($locationId){
                    return $query->where("location_id", $locationId);
                });
        };

                //evite deux paiement par un meme utilisateur
                $this->validate([
                    "newPaiement.user_id" => [
                        "required",
                        $uniqueRole()
                    ],
                    "newPaiement.montant" => "required|numeric",
                     "newPaiement.datePaiement" => "required",
                ],
                ["newPaiement.user_id.unique" => "Desolé ! \n Il existe déjà un Paiement par cet utilisateur !"]
            );


            Paiement::updateOrCreate(
                //si tu trouve un location dejà loué tu le met à jour sinon tu le cree
                [
                    "user_id" => $this->newPaiement["user_id"],
                    "location_id" => $locationId
                ],

                [
                    "montant" => $this->newPaiement["montant"],
                    "datePaiement" => $this->newPaiement["datePaiement"]
                ],
                // [
                //     "datePaiement" =>$this->newPaiement["datePaiement"]
                // ],
                );

                $this->cancelPaiement() ;
            }

            public function cancelPaiement(){
                $this->addPaiement = false;
                $this->resetErrorBag() ;
                $this->newPaiement = [] ;
            }


            public function confirmDelete($id){
                $this->dispatchBrowserEvent("showConfirmMessage", ["message" =>
                [
                        "text" => "Vous êtes sur le point de supprimer ce Paiement",
                        "title" => "Êtes-vous sûr de continuer ? ",
                        "type" =>"warning",
                        "data" => [
                            "paiement_id" => $id
                        ]
                    ]
                ]);
        }

        public function deletePaiement(Paiement $paiement){
                $paiement->delete() ;
        }

            
}


