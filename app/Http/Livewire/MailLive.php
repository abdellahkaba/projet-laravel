<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MailLive extends Component
{
    public $currentPage = PAGECREATEFORM ;
    public function render()
    {
        return view('livewire.mails.create',)
        ->extends("layouts.master")
        ->section("content");
    }

    public function store(){
        return view('livewire.mails.store') ;
    }
}
