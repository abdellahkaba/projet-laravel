<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategorieLive extends Component
{
    public $pageCategorie = CATEGORIELISTE ;
    public function render()
    {
        return view('livewire.categories.index')
        ->extends('layouts.master')
        ->section('content');
        ;
    }
}
