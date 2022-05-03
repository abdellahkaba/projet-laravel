<?php

namespace App\Http\Livewire;

use App\Models\ProprieteArticle;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\TypeArticle;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class TypeArticleLive extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = "";//
    public $isAddTypeArticle = false;
    public $newTypeArticleName = "";
    public $newValue = "" ;
    public $newAddPropriete = [] ;
    public $selectedTypeArticle = "" ;
    public $pageCourant = PROPRIETEINDEX ;


    public function render(){

        Carbon::setLocale("fr");
        $critereRecherche = "%".$this->search."%" ;//


        $data = [
            "typearticles" => TypeArticle::where("nom","like",$critereRecherche)->latest()->paginate(3),
            "proprietesTypeArticles" => ProprieteArticle::where("type_article_id",optional($this->selectedTypeArticle)->id)->latest()->paginate(4)
        ];

        return view('livewire.typearticles.parent' , $data)
            ->extends("layouts.master")
            ->section("content");
    }


    public function showTypeArticleForm(){
        if($this->isAddTypeArticle){
           $this->isAddTypeArticle = false;
          $this->newTypeArticleName = "";
          $this->resetErrorBag(["newTypeArticleName"])  ;
        }
        else{
           $this->isAddTypeArticle = true;
        }

    }

    //
    public function addNewTypeArticle(){
        $validated = $this->validate([
            "newTypeArticleName" => "required|max:40|unique:type_articles,nom"
        ]) ;
        TypeArticle::create(["nom" => $validated["newTypeArticleName"] ]);

        $this->showTypeArticleForm();

        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
        "Ajouté avec succès !"]);
    }

    // public function editTypeArticle($id){
    //     $typeArticle = TypeArticle::find($id);
    //     $this->dispatchBrowserEvent("showEditForm",["typearticle" => $typeArticle]) ;
    // }

    public function editTypeArticle(TypeArticle $typeArticle){
        $this->dispatchBrowserEvent("showEditForm",["typearticle" => $typeArticle]) ;
    }

    public function updateTypeArticle($id, $newValeur){
        $this->newValue = $newValeur;
        $validated = $this->validate([
            "newValue" => ["required","max:40" , Rule::unique("type_articles","nom")->ignore($id)]
        ]);
        TypeArticle::find($id)->update(["nom" =>$validated["newValue"]]);
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
        "Type d'article mis à jour avec success !"]);
    }

        //confirmation de la suppression
    public function confirmDelete($id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" =>
        [
                "text" => "Vous êtes sur le point de supprimer  de la liste d'article
                Voulez-vous continuer ? ",
                "title" => "Êtes-vous sûr de continuer ? ",
                "type" =>"warning",
                "data" => [
                    "type_article_id" => $id
                ]
            ]
        ]);
    }

    //Suppression
    public function deleteTypeArticle($id){
        TypeArticle::destroy($id);
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
         "Type d'article supprimé avec succès !"]);
    }


    //Propriete



    public function gotoPropriete(TypeArticle $typeArticle){
        $this->selectedTypeArticle = $typeArticle ;
        $this->pageCourant = PROPRIETEPAGE;

    }
    //proprieté d'ajout
    public function addPropriete(){
       $validated = $this->validate([
            "newAddPropriete.nom" => [
                "required" ,
                Rule::unique("propriete_articles","nom")->where("type_article_id" , $this->selectedTypeArticle["id"])
            ],
            "newAddPropriete.estObligatoire" => ["required"]
        ]);

        ProprieteArticle::create([
            "nom" => $this->newAddPropriete["nom"],
            "estObligatoire" => $this->newAddPropriete["estObligatoire"],
            "type_article_id" => $this->selectedTypeArticle["id"],
        ]);

        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>"Proprieté affecté avec success"]) ;
        $this->newAddPropriete = [] ;
        $this->resetErrorBag() ;
    }

    //Retour A la liste de type d'article
    public function backTypeArticle(){
        $this->pageCourant = PROPRIETEINDEX;
    }
    public function showProp(TypeArticle $typeArticle){
        $this->dispatchBrowserEvent("show" , ["message" => ""]);
    }
    //confirmation de suppression
    public function showDeleteProp($id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" =>
        [
                "text" => "Vous êtes sur le point de supprimer  de la liste des Proprietés d'article
                Voulez-vous continuer ? ",
                "title" => "Êtes-vous sûr de continuer ? ",
                "type" =>"warning",
                "data" => [
                    "propriete_article_id" => $id
                ]
            ]
        ]);
    }
    //suppression
    public function deleteProp($id){
        ProprieteArticle::destroy($id);
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
         "Proprieté de l'article supprimé supprimé avec succès !"]);
    }
    //confirmation de modification
    public function showEditProp(ProprieteArticle $prop){
        $this->dispatchBrowserEvent("showEditFormProp",["prop" => $prop]) ;
    }
    //Modification de type d'article
    public function updateProprieteArticle($id , $newValeur){
        $this->newValue = $newValeur;
        $validated = $this->validate([
            "newValue" => ["required","max:40" , Rule::unique("propriete_articles","nom")->ignore($id)]
        ]);
        ProprieteArticle::find($id)->update(["nom" =>$validated["newValue"]]);
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
        "Proprité d'article mis à jour avec success !"]);
    }
}
