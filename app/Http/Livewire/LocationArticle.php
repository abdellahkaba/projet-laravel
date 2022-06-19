<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Article;
use Livewire\Component;
use App\Models\Location;
use App\Models\TypeArticle;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class LocationArticle extends Component
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
        $articleQuery = Article::query() ;
        if($this->search != ""){
            $articleQuery->where("nom","LIKE","%" . $this->search . "%")
            ->orWhere("noSerie","LIKE","%".  $this->search ."%");
        }
        return view('livewire.locations.create',[
            "articles" => $articleQuery->latest()->paginate(5),
            "typearticles" => TypeArticle::orderBy("nom","ASC")->get(),
            'locations' => Location::all(),
        ])->extends("layouts.master")->section("content");
    }



    public function gotoListLocation(){
        $this->currentPage = PAGECREATEFORM;
    }

    // public function searchEssaie($search){
    //     foreach(Location::all() as $location){
    //         if($location->dateFin < $search){
    //             "<script>
    //                 alert('Trouvé')
    //             </script>";
    //         }
    //     }
    // }
}
