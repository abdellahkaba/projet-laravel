<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Article;
use App\Models\ArticlePropriete;
use Livewire\Component;
use App\Models\TypeArticle;
use Livewire\WithPagination;

class ArticleLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = "";
    public $filtreType = "";
    public $filtreEtat = "" ;
    public $addArticle = [] ; //
    public $proprieteArticles = null ;// une fonction qui prend les proprietés article
    //les variables de pagination
    public $ArticlePage = ARTICLELISTE;
    public function render(){
        Carbon::setLocale("fr");
        $articleQuery = Article::query() ;
        if($this->search != ""){
            $articleQuery->where("nom","LIKE","%" . $this->search . "%")
            ->orWhere("noSerie","LIKE","%".  $this->search ."%");
        }

        //filtrer par type
        if($this->filtreType != ""){
            $articleQuery->where("type_article_id",$this->filtreType);
        }
        //filter par etat
        if($this->filtreEtat != ""){
            $articleQuery->where("estDisponible",$this->filtreEtat);
        }
        return view('livewire.articles.index' , [
            "articles" => $articleQuery->latest()->paginate(5),
            "typearticles" => TypeArticle::orderBy("nom","ASC")->get()
        ])
            ->extends('layouts.master')
            ->section('content');
    }

    //A chaque fois une valeur sera modifier cette fonction va s'appeler
    public function updated($property){
        if($property == "addArticle.type"){
            //on recupère la valeur du type qui a été selectionné
            $this->proprieteArticles = optional(TypeArticle::find($this->addArticle["type"]))->proprietes;
        }

    }

    //page ajout Article

    public function gotoaddArticle(){
       $this->ArticlePage = ARTICLECREATE ;
    }

    // Ajout d'un article
    public function addArticle(){
        $validateArr = [
            "addArticle.nom" => "string|min:3|required",
            "addArticle.noSerie" => "string|max:50|min:3|required",
            "addArticle.type" => "required"
        ];

            $customerErrorMessage = [] ;
            $propId = [] ;

        foreach($this->proprieteArticles ? : [] as $propriete){


            $field = "addArticle.prop.".$propriete->nom ;
            $propId[$propriete->nom] = $propriete->id ;


            if($propriete->esObligatoire == 1){
               // $validateArr[$field] = "required";
                $validateArr[$field] = "required";
                $customerErrorMessage["$field.required"] = "Le champ" .$propriete->nom . " est Obligatoire" ;
            }
            else{
              $validateArr[$field] = "nullable";
            }


        }
        //dump($validateArr) ;
        $validatedData = $this->validate($validateArr , $customerErrorMessage);



        $article = Article::create([
            "nom" => $validatedData["addArticle"]["nom"],
            "noSerie" => $validatedData["addArticle"]["noSerie"],
            "type_article_id" => $validatedData["addArticle"]["type"]
        ]) ;

        foreach($validatedData["addArticle"]["prop"] ? : [] as $key => $prop){
            ArticlePropriete::create([
                "article_id" => $article->id ,
                "propriete_article_id" => $propId[$key] ,
                "valeur" => $prop
            ]);
        }

        $this->dispatchBrowserEvent("showSuccessMessage" , ["message", "Article ajouté avec success ! "]) ;

        $this->proprieteArticles = [] ;
        $validatedData = [] ;
        $this->ArticlePage  = ARTICLELISTE ;
    }
    public function gotoListArticle(){
        $this->ArticlePage = ARTICLELISTE  ;
    }

    //edition d'article
    public function editArticle(Article $article){

    }
    //confirmation delete d'article
    public function confirmDelete(Article $article){

    }
    // initialisation de la table
    public function tableInitialise(){
        $this->addArticle = [];
    }
}
