<?php

namespace App\Http\Livewire;

use App\Mail\Testmail;
use Livewire\Component;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class MailLive extends Component
{
    public $nom = "";
    public $mail = "" ;
    public $message = "";

    protected $rules = [
        "nom" => "required",
        // "message" => "required",
        // "email" => "required"
    ] ;

    public function saveMessage() {
        $this->validate() ;
        Message::create([
            'nom' => $this->nom,
            // 'message' => $this->message,
            // 'email' => $this->email
        ]);

        Mail::to("abdallahkaba98@gmail.com")->send(new Testmail($this->mailableName)) ;

        $this->nom = '';
        $this->email = '';
        $this->message = '';
    }

    public $currentPage = PAGECREATEFORM ;
    public function render()
    {
        return view('livewire.emails.create',)
        ->extends("layouts.master")
        ->section("content");
    }

    public function store(){
        return view('livewire.mails.store') ;
    }
}
