<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Paiement;



class PaiementList extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $search = "";

    public function render()
    {
        Carbon::setLocale("fr"); //Traduction de la page en français
       // $rechercherParNom = "%".$this->search."%";
        //$users = User::where("nom","like",$rechercherParNom)->latest()->paginate(8);
        $paiements = Paiement::all() ;

        return view('livewire.paiements.liste',
            [
                "paiements" => $paiements
            ]
        )
            ->extends("layouts.master")
            ->section("content")
        ;
    }
}
