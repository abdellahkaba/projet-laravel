<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Article;
use App\Models\DureeLocation;
use Livewire\Component;
use App\Models\Tarification;

class TarificationComp extends Component
{
    public function render()
    {
        return view('livewire.tarifications.liste' , 
            [
                "tarifs" => Tarification::all(),
                "users" => User::all() ,
                "articles" => Article::all(),
                "duree_locations" => DureeLocation::all()
            ]
    )       ->extends("layouts.master")
            ->section("content")
    ;
    }
}
