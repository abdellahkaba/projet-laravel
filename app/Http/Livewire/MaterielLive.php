<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MaterielLive extends Component
{
    public $pageMateriel = MATERIELLISTE ;
    public function render()
    {
        return view('livewire.materiels.index')
        ->extends('layouts.master')
        ->section('content');
        ;
    }
}
