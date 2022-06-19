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

class PrintLocation extends Component
{
    use WithPagination ;
    use WithFileUploads ;
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
        "locations" => Location::all(),
        "statuts" => StatutLocation::all(),
        "clients" => Client::orderBy("nom","ASC")->get(),
        "users" => User::orderBy("nom","ASC")->get(),

    ];

    return view('livewire.locations.printliste',
        $data
    )->extends("layouts.master")->section("content");
}
}
