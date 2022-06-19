<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function create(){
        return view('livewire.mails.create')
        ->extends("layouts.master")
        ->section("content");
    }

    public function store(){
        dd("bien");
    }
}



    

    