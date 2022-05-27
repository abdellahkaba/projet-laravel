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
        //rechercher par

        // $locationQuery = Location::query() ;
        // if($this->search != ""){
        //     $locationQuery->where("nom","LIKE","%" . $this->search . "%")
        //     ->orWhere("noSerie","LIKE","%".  $this->search ."%");
        // }

        //filtrer par Statut
        // if($this->filtreStatut != ""){
        //     $locationQuery->where("statut_location_id",$this->filtreStatut);
        // }

        // $data = [
        //     // "locations" =>$locationQuery->get(),
        //     "article" => Article::orderBy("nom","ASC")->get(),
        //     "clients" => Client::orderBy("nom","ASC")->get(),
        //     // "statuts" => StatutLocation::orderBy("nom","ASC")->get(),
        //     "users" => User::orderBy("nom","ASC")->get(),

        // ];

       $data = [
            'locations' => Location::with(["statuts"])->whereArticleId($this->article->id)
            ->get(),
            "statuts" => StatutLocation::all(),
            "clients" => Client::orderBy("nom","ASC")->get(),
            "users" => User::orderBy("nom","ASC")->get(),

        ];

        return view('livewire.locations.index',
            $data
        )
                ->extends("layouts.master")
                ->section("content");
    }

    //Renvoie l'identifiant en parametre
    public function mount($articleId){
        $this->article = Article::find($articleId);
    }

//     protected $rules = [
//         "addLocation.dateDebut" => "required",
//         "addLocation.dateFin" => "required",
//         "addLocation.client" => "required",
//         "addLocation.user" => "required",
//         "addLocation.statuts" => "required",
//         "addLocation.articles" => "required",


//     ];
//     public function gotoListLocation(){
//         $this->currentPage = PAGELISTE;
//     }
//     public function gotoAddLocation(){
//         $this->currentPage = PAGECREATEFORM ;
//     }

//    public function addLocation(){
//         $validated = $this->validate();
//         Location::create([
//             "dateDebut" => $validated["addLocation"]["dateDebut"],
//             "dateFin" => $validated["addLocation"]["dateFin"],
//             "client_id" => $validated["addLocation"]["client"],
//             "user_id" => $validated["addLocation"]["user"],
//             "statut_location_id" => $validated["addLocation"]["statuts"],
//             "article_id" => $validated["addLocation"]["articles"]
//         ]);

//         // ArticleLocation::create([
//         //     "article_id" => $validated["addLocation"]["article"],
//         //     "location_id" => $validated["addLocation"]["locations"]
//         // ]);
//         $this->dispatchBrowserEvent("showSuccessMessage",["message","Location effectuée avec succès"]);
//    }


public function newLocation(){
    $this->addLocation = true;
}

//function d'edition

public function editLocation(Location $Location){
    $this->addLocation = true;
    $this->newLocation = $Location->toArray();
    $this->newLocation["edit"] = true;
}

public function saveLocation(){

    $articleId = $this->article->id;
    $newLocation = $this->newLocation;

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
        "newLocation.statut_location_id" => [
            "required",
            $uniqueRole()
        ],
        "newLocation.dateDebut" => "required",
        "newLocation.dateFin" => "required",
        "newLocation.client" => "required",
        "newLocation.user" => "required",
    ],
    ["newLocation.statut_location_id.unique" => "Desolé ! \n Il existe déjà un Location pour cette duree location !"]
    );
        Location::updateOrCreate(
    //si tu trouve un article dejà loué tu le met à jour sinon tu le cree
    [
        "statut_location_id" => $this->newLocation["statut_location_id"],
        "article_id" => $articleId
    ],

    [
        "dateDebut" => $this->newLocation["dateDebut"],
        "dateFin" => $this->newLocation["dateFin"],
        "client_id" => $this->newLocation["client"],
        "user_id" => $this->newLocation["user"],

    ]
    );

    $this->cancelLocation() ;
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


