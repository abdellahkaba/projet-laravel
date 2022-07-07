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
            "paiements" => Paiement::whereLocationId($this->location->id)->get(),
            "users" =>  User::all()
        ])->extends("layouts.master")->section("content");
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
            $this->validate([
                "newPaiement.montant" => "required|numeric",
                "newPaiement.datePaiement" => "required",
                "newPaiement.user_id" => "required",
            ],);
            Paiement::create(
                [
                    "user_id" => $this->newPaiement["user_id"],
                    "location_id" => $locationId,
                    "montant" => $this->newPaiement["montant"],
                    "datePaiement" => $this->newPaiement["datePaiement"]
                ],
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


