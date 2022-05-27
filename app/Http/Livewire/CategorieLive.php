<?php

namespace App\Http\Livewire;

use App\Models\Categorie;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
class CategorieLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = "" ;
    public $newValue ;
    public $isAddCategorieMateriel = false;
    public $newCategorieName = "" ;
    public $selectedCategorie = "" ;
    public $newAddCategorie = [] ;
    public $pageCategorie = CATEGORIELISTE ;
    public function render()
    {
        Carbon::setlocale("fr");
        $critereRecherche = "%".$this->search."%" ;
        $data = [
            "categories" => Categorie::where("nom","like",$critereRecherche)->latest()->paginate(3)
        ];

        return view('livewire.categories.index' , $data)
        ->extends('layouts.master')
        ->section('content');
        ;
    }

    //function qui change les pages entre elles
    public function showCategorieForm(){
        if($this->isAddCategorieMateriel){
            $this->isAddCategorieMateriel = false;
            $this->newCategorieName = "";
            $this->resetErrorBag(["newCategorieName"]);
        }
        else{
            $this->isAddCategorieMateriel = true;
        }
    }

    public function addNewCategorie(){
        $validated = $this->validate([
            "newCategorieName" => "required|max:40|unique:categories,nom"
        ]);

        Categorie::create(["nom" => $validated["newCategorieName"]]);

        $this->showCategorieForm() ;

        
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
        "Ajouté avec succès !"]);
    }

    public function editCategorie(Categorie $categorie){
        $this->dispatchBrowserEvent("showEditForm",["categorie" => $categorie]);
    }

    public function updateCategorie($id , $newValeur){
        $this->newValue = $newValeur;
        $validated = $this->validate([
            "newValue" => ["required","max:40",Rule::unique("categories","nom")->ignore($id)]
        ]);

        Categorie::find($id)->update(["nom" => $validated["newValue"]]);
        $this->dispatchBrowserEvent("showSuccessMessage",["message" => "Categorie Materiel mis à jour avec succèss !"]) ;
    }

    //confirmation du message de suppression

    public function confirmDelete($id){
        $this->dispatchBrowserEvent("showConfirmMessage",["message" => [
            "text" => "Vous êtes sur le point de supprimer ce categorie de la liste Voulez-vous continuer ? " ,
            "title" => "Êtes-vous sûr de continuer ? ",
            "type" => "warinig" , 
            "data" => [
                "categorie_id" => $id
            ]
        ]]);
    }

    //Suppression de catégorie
    public function deleteCategorie($id){
        Categorie::destroy($id) ;

        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
        "Catégorie matériel supprimé avec succès !"]);
    }

    //Retour à liste de Catégorie matériel
    public function backCategorie(){
        $this->pageCategorie = CATEGORIELISTE;
    }
}
