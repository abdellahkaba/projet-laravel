<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Article;
use Livewire\Component;
use App\Models\Location;
use App\Models\TypeArticle;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class LocationEncour extends Component
{
    use WithPagination ;
    use WithFileUploads ; //upload des fichier (image , document excet etc ....)
    protected $paginationTheme = 'bootstrap';

    public $filtreType = "";
    public $filtreEtat = "" ;
    public $search = "";
    public function render()
    {
        Carbon::setLocale("fr");
        //$articleQuery = Article::query() ;
        // $locationQuery = Location::query();
        // $rechercherParDate = "%".$this->search."%";
        // $locations = Location::where("dateFin","like",$rechercherParDate)->latest()->paginate(5);
        // if($this->search > "dateFin"){
        //     $locationQuery->where("dateFin","LIKE","%" . $this->search . "%");

        // }
        return view('livewire.locations.encour',[
            //"articles" => $articleQuery->latest()->paginate(5),
            //"typearticles" => TypeArticle::orderBy("nom","ASC")->get(),
            
            'locations' => Location::latest()->paginate(5),
            "articles" => Article::all()
        ])->extends("layouts.master")->section("content");
    }

    public $searchDate = "";
    public $resultat = null;

    public function dateChercher(){
        foreach(Location::all() as $location){
            if($location->dateFin < $this->searchDate){
                $this->resultat = $location;
              return $this->resultat ;
            }
        }
    }
}



