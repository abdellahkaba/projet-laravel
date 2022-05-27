<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\DureeLocation;
use Livewire\Component;
use App\Models\Tarification;
use Illuminate\Validation\Rule;

class TarificationLive extends Component
{

    public Article $article ; //On a besoin de l'article à tarifier

    public $newTarif = [] ; //Un tableau qui stock les valeurs de tarification

    public $addTarif = false ; //Permet d'ajouter une tarification

    //Renvoie l'identifiant en parametre
    public function mount($articleId){
        $this->article = Article::find($articleId);
    }



    public function render()
    {
        return view('livewire.tarifications.index' , [
            'tarifs' => Tarification::with(["dureeLocation"])->whereArticleId($this->article->id)
            ->get(),
            "dureeLocations" => DureeLocation::all()
             // where("article",3)
        ])
            ->extends("layouts.master")
            ->section("content");
    }

    public function newTarif(){
        $this->addTarif = true;
    }

    //function d'edition

    public function editTarif(Tarification $tarif){
        $this->addTarif = true;
        $this->newTarif = $tarif->toArray();
        $this->newTarif["edit"] = true;
    }

    public function saveTarif(){

        $articleId = $this->article->id;
        $newTarif = $this->newTarif;

        $uniqueRole = function() use($newTarif,$articleId){

            return (isset($newTarif["edit"])) ?

            Rule::unique((new Tarification())->getTable() , "duree_location_id")
                ->ignore($newTarif["id"] , "id")
                ->where(function($query) use ($articleId){
                    return $query->where("article_id", $articleId);
                })
                :
                Rule::unique((new Tarification())->getTable() , "duree_location_id")
                ->where(function($query) use ($articleId){
                    return $query->where("article_id", $articleId);
                });
        };


        //evite deux tarifs pour une même journée
        $this->validate([
            "newTarif.duree_location_id" => [
                "required",
                $uniqueRole()
            ],
            "newTarif.prix" => "required|numeric"
        ],
        ["newTarif.duree_location_id.unique" => "Desolé ! \n Il existe déjà un Tarif pour cette duree location !"]
    );
    Tarification::updateOrCreate(
        //si tu trouve un article dejà loué tu le met à jour sinon tu le cree
        [
            "duree_location_id" => $this->newTarif["duree_location_id"],
            "article_id" => $articleId
        ],

        [
            "prix" => $this->newTarif["prix"]
        ]
        );

        $this->cancelTarif() ;
    }

    public function cancelTarif(){
        $this->addTarif = false;
        $this->resetErrorBag() ;
        $this->newTarif = [] ;
    }
}
