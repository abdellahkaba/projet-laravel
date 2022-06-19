<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\Article;
use Livewire\Component;
use App\Models\Location;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\StatutLocation;
use App\Models\ArticleLocation;
use Illuminate\Validation\Rule;

class LocationLive extends Component
{
    use WithPagination ;
    use WithFileUploads ; //upload des fichier (image , document excet etc ....)
    protected $paginationTheme = 'bootstrap';
    public $search = "";
    public $locationQuery ="";
    public $filtreStatut = "";
    public $articleLocation = null ;
    public $addArticle = [] ;
    public $currentPage = PAGELISTE ;
    //public $addLocation = [];
    public $editLocation = [] ;
    public Article $article ;
    public $newLocation = [] ;
    public $addLocation = false ;
public function render()
{
    Carbon::setLocale("fr");
    $data = [
        'locations' => Location::with(["statuts"])->whereArticleId($this->article->id)
        ->get(),
        "statuts" => StatutLocation::all(),
        "clients" => Client::orderBy("nom","ASC")->get(),
        "users" => User::orderBy("nom","ASC")->get(),

    ];

    return view('livewire.locations.index',
        $data
    )->extends("layouts.master")->section("content");
}

//Renvoie l'identifiant en parametre
public function mount($articleId){
    $this->article = Article::find($articleId);
}

public function newLocation(){
    $this->addLocation = true;
}

//function d'edition

public function editLocation(Location $Location){
    $this->addLocation = true;
    $this->editLocation = $Location->toArray();
    $this->currentPage = PAGEEDITFORM ;
}

public function updateLocation(){

    $articleId = $this->article->id ; 
    $editLocation = $this->editLocation ;
    
        $uniqueRole = function() use($editLocation,$articleId){
    
            return (isset($editLocation["edit"])) ?
    
            Rule::unique((new Location())->getTable() , "statut_location_id")
                ->ignore($editLocation["id"] , "id")
                ->where(function($query) use ($articleId){
                    return $query->where("article_id", $articleId);
            })
                :
            Rule::unique((new Location())->getTable() , "statut_location_id")
                ->where(function($query) use ($articleId){
                    return $query->where("article_id", $articleId);
            });
        };
        //evite deux Locations pour une même journée
        $validationAttributes= $this->validate([
            "editLocation.statut_location_id" => ["required", $uniqueRole()],
                "editLocation.dateDebut" => "required",
                // "editLocation.dateFin" => "required",
                // "editLocation.client" => "required",
                "editLocation.user" => "required",
            ],
            ["editLocation.statut_location_id.unique" => "Desolé ! \n Il existe déjà un Location pour cette duree location !"]
            );
         
        Location::find($this->editLocation['id'])->update($validationAttributes["editLocation"]);
        $this->dispatchBrowserEvent("showSuccessMessage" , ["message" => "Location Terminé vous pouvez le supprimer Maintenant ! "]);

        $this->editLocation = [] ;
}

public function saveLocation(){

    $articleId = $this->article->id ; 
    $newLocation = $this->newLocation ;

        $uniqueRole = function() use($newLocation,$articleId){

            return (isset($newLocation["edit"])) ?

            Rule::unique((new Location())->getTable() , "statut_location_id")
                ->ignore($newLocation["id"] , "id")
                ->where(function($query) use ($articleId){
                    return $query->where("article_id", $articleId);
            })
                :
            Rule::unique((new Location())->getTable() , "statut_location_id")
                ->where(function($query) use ($articleId){
                    return $query->where("article_id", $articleId);
            });
        };
        //evite deux Locations pour une même journée
        $this->validate([
            "newLocation.statut_location_id" => ["required", $uniqueRole()],
                "newLocation.dateDebut" => "required",
                "newLocation.dateFin" => "required",
                "newLocation.client" => "required",
                "newLocation.user" => "required",
            ],
            ["newLocation.statut_location_id.unique" => "Desolé ! \n Il existe déjà un Location pour cette duree location !"]
            );
         Location::create([
            "statut_location_id" => $this->newLocation["statut_location_id"],
            "article_id" => $articleId,
            "dateDebut" => $this->newLocation["dateDebut"],
            "dateFin" => $this->newLocation["dateFin"],
            "client_id" => $this->newLocation["client"],
            "user_id" => $this->newLocation["user"],
        ],
    );

    $this->dispatchBrowserEvent("showSuccessMessage" , ["message" => "Location Enregistré avec succèss ! "]);
}

public function cancelLocation(){
    $this->addLocation = false;
    $this->resetErrorBag() ;
    $this->newLocation = [] ;
}

public function deleteLocation(Location $location){
    if(count($location->paiements)>0){
        $this->dispatchBrowserEvent("showDangerMessage",["message" =>
        "Veuillez supprimer le paiement de cette location d'abord !"]);
        return ;
    }
    $location->delete() ;
}

public function confirmDelete($id){
    $this->dispatchBrowserEvent("showConfirmMessage", ["message" =>
    [
            "text" => "Vous êtes sur le point de supprimer cette location",
            "title" => "Êtes-vous sûr de continuer ? ",
            "type" =>"warning",
            "data" => [
                "location_id" => $id
            ]
        ]
    ]);
}

}


