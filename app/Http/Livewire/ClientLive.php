<?php

namespace App\Http\Livewire;
use Carbon\Carbon;
use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
class ClientLive extends Component
{

    use WithPagination ;
    public $search = "";

    protected $paginationTheme = 'bootstrap';
    public $isbtnaddClick = false ; //verifier si le nouvel Client a été ajouté

    public $newClient = [] ;

    public $addClient = [] ;

    public $editClient = [] ;

    public $currentPage = PAGELISTE ;

    public function rules(){
        if($this->currentPage == PAGEEDITFORM){
            return [
                'editClient.nom' => 'required',
                'editClient.prenom' => 'required',
                'editClient.sexe' => 'required',
                'editClient.dateNaiss' => 'required',
                'editClient.lieuNaiss' => 'required',
                'editClient.ville' => 'required',
                'editClient.telephone' => ['required','numeric',Rule::unique("clients","telephone")->ignore($this->editClient["id"])],
                'editClient.adresse' => 'required',
            ];
        }

        return [
            'addClient.nom' => 'required',
            'addClient.prenom' => 'required',
            'addClient.sexe' => 'required',
            'addClient.dateNaiss' => 'required',
            'addClient.lieuNaiss' => 'required',
            'addClient.ville' => 'required',
            'addClient.telephone' => 'required|numeric|unique:clients,telephone',
            'addClient.adresse' => 'required',
            //'addClient.email' => 'required|email|unique:Clients,email',
        ];
    }

    protected $messages = [
        'addClient.nom.required' => 'Saisir le nom.',
        'addClient.prenom.required' => 'Saisir le prenom.',
        'addClient.sexe.required' => 'selectionner un sexe.',
        'addClient.dateNaiss.required' => 'Donner la date de naissance.',
        'addClient.lieuNaiss.required' => 'Donner le lieu de naissance.',
        'addClient.ville.required' => 'Saisir la ville de provenance.',
        'addClient.telephone.required' => 'Donner un contact.',
        'addClient.adresse.required' => 'Saisir l\'adresse.',
    ];

    public function render(){

        Carbon::setLocale("fr"); //Traduction de la page en français
        $rechercherParNom = "%".$this->search."%";
        $clients = Client::where("nom","like",$rechercherParNom)->latest()->paginate(5);
        return view('livewire.clients.index' , ["clients" => $clients])
            ->extends('layouts.master')
            ->section('content');
    }



    public function gotoaddClient(){
        $this->currentPage = PAGECREATEFORM;
    }

    public function gotoListClient(){
        $this->currentPage = PAGELISTE;
        $this->editClient = [];
        $this->resetErrorBag() ;
    }

    public function gotoEditClient($id){
        $this->editClient = Client::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
    }

    public function addClient(){
       $validationAttributes = $this->validate();
       Client::create($validationAttributes["addClient"]);
       $this->addClient = [];
        $this->currentPage = PAGELISTE ;

        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
        "Client ajouté avec succès ! "]);
    }

    //Modification

    public function updateClient(){
        $validationAttributes = $this->validate();
        Client::find($this->editClient["id"])->update($validationAttributes["editClient"]);
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
         "Client mis à jour avec succès ! "]);

         $this->currentPage = PAGELISTE;
    }

    //confirmation de la suppression
    public function confirmDelete($id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" =>
        [
            "text" => "Vous êtes sur le point de supprimer cet Client
             Voulez-vous continuer ? ",
            "title" => "Êtes-vous sûr de continuer ? ",
            "type" =>"warning",
            "data" => [
                "client_id" => $id
            ]
        ]
        ]);

    }

    //function de suppression
    public function deleteClient(Client $client){
        if(count($client->locations) > 0){
            $this->dispatchBrowserEvent("showDangerMessage",["message" =>
            "Desolé ce client a dejà une location enregistré !"]);
            return ;
        }

        $client->delete();
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
         "Client supprimé avec succès !"]);
    }
}

