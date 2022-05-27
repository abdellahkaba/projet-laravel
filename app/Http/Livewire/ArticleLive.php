<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Article;
use Livewire\Component;
use App\Models\TypeArticle;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Models\ArticlePropriete;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ArticleLive extends Component
{
    use WithPagination ;
    use WithFileUploads ; //upload des fichier (image , document excet etc ....)
    protected $paginationTheme = 'bootstrap';
    public $search = "";
    public $filtreType = "";
    public $filtreEtat = "" ;
    public $addArticle = [] ; //
    public $proprieteArticles = null ;// une fonction qui prend les proprietés article
    public $addPhoto = null ;
    public $editPhoto = null;
    public $editArticle = [] ; //fonction d'edition d'article
    public $editChanged = false ;
    public $editArticleValue = [] ;
    //les variables de pagination
    public $ArticlePage = ARTICLELISTE;

    //Validation definie pour l'edition de l'article
    public function rules(){
        if($this->ArticlePage == ARTICLEEDIT){
             return [
                'editArticle.nom' => ['required' , Rule::unique("articles,nom")->ignore($this->editArticle["id"])],
                'editArticle.noSerie' => ['required' , Rule::unique("articles,noSerie")->ignore($this->editArticle["id"])],
                'editArticle.type_article_id' => 'required|exists:App\Models\TypeArticle,id',
                'editArticle.article_proprietes.*.valeur' => 'required'

            ] ;
        }

        //return $this->addArticle();
    }

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
        //
        if($this->editArticle != []){
            $this->showUpdateButton();
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
        $this->addArticle = [];
       $this->ArticlePage = ARTICLECREATE ;

    }



    // Ajout d'un article
    public function addArticle(){
        $validateArr = [
            "addArticle.nom" => "string|min:3|required|unique:articles,nom",
            "addArticle.noSerie" => "string|max:50|min:3|required|unique:articles,noSerie",
            "addArticle.type" => "required",
            "addPhoto" => 'image|max:10240'
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

        $validatedData = $this->validate($validateArr , $customerErrorMessage);

        $imagePath = "images/imageplaceholder.png" ;
        //avant il faut créer un lien symbolique entre le dossier storage et public pour l'insertion de l'image
        //(php artisan storage:link)
        if($this->addPhoto != null){
          $path = $this->addPhoto->store('upload', 'public');

          $imagePath = "storage/".$path ;
          //Redimensionner une image
          $image = Image::make(public_path($imagePath))->fit(204,204) ;
          $image->save() ;
        }


        $article = Article::create([
            "nom" => $validatedData["addArticle"]["nom"],
            "noSerie" => $validatedData["addArticle"]["noSerie"],
            "type_article_id" => $validatedData["addArticle"]["type"],
            "imageUrl" => $imagePath
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
        $this->addArticle = [];
        $this->addPhoto = [] ;
        $this->ArticlePage  = ARTICLELISTE ;
       // $this->customerErrorMessage = [] ;
    }
    public function gotoListArticle(){
        $this->ArticlePage = ARTICLELISTE  ;
        $this->addPhoto = null ;
        $this->addArticle = [];
    }

    //fonction de retour à la liste pour l'edition

    public function listeArticle(){

        $this->ArticlePage = ARTICLELISTE;
    }


    // une fonction pour voir le button de modification

    function showUpdateButton(){
        $this->editChanged = false;

        foreach($this->editArticleValue["article_proprietes"] as $index => $editValue){
            if($this->editArticle["article_proprietes"][$index]["valeur"] != $editValue["valeur"]){
                $this->editChanged = true ;
            }
        }

        //Verification

        if(
            $this->editArticle["nom"] != $this->editArticleValue["nom"] ||
            $this->editArticle["noSerie"] != $this->editArticleValue["noSerie"] ||
            $this->editPhoto != null

        ) {
            $this->editChanged = true ;
        }

         $this->editChanged ;
    }


    //edition d'article
    public function editArticle($articleid){

        $this->ArticlePage = ARTICLEEDIT;

        //with() : charge les articles avec les valeurs de leurs relations

        $this->editArticle = Article::with("article_proprietes" , "article_proprietes.propriete" , "type")->find($articleid)->toArray() ;

        //Prendre la valeur actuelle d'article et le mettre

        $this->editArticleValue = $this->editArticle ;

        $this->editPhoto = null;



    }
    //confirmation delete d'article
    public function confirmDelete($id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" =>
        [
                "text" => "Vous êtes sur le point de supprimer cet article  de la liste d'article
                Voulez-vous continuer ? ",
                "title" => "Êtes-vous sûr de continuer ? ",
                "type" =>"warning",
                "data" => [
                    "article_id" => $id
                ]
            ]
        ]);

    }
    // initialisation de la table
    public function tableInitialise(){
        $this->addArticle = [];
    }

    //funciton de Modification
    public function updateArticle()
    {


        //Recuperer l'article à editer
        // $this->validate() ;
        $article = Article::find($this->editArticle["id"]) ;

        //Mettre toutes ces variables dans un tableau

        $article->fill($this->editArticle) ;

        //Modification de l'image
        if($this->editPhoto != null){
            $path = $this->editPhoto->store('upload', 'public');

            $imagePath = "storage/".$path ;
            //Redimensionner une image
            $image = Image::make(public_path($imagePath))->fit(204,204) ;

            $image->save() ;

            //suppression de l'ancienne image par la nouvelle
            Storage::disk("local")->delete(str_replace("storage/","public" , $article->imageUrl()));

            $article->imageUrl = $imagePath ;
        }
;
        $article->save() ;

        //Recuperer la proprieté article et mettre à jour sa valeur

        collect($this->editArticle["article_proprietes"])->
        each(
            fn($item) => ArticlePropriete::where(
            [
                "article_id" => $item["article_id"] ,
                "propriete_article_id" => $item["propriete_article_id"]
            ])->update(["valeur" => $item["valeur"]])
        ) ;

        $this->dispatchBrowserEvent("showSuccessMessage",["message" => "Article Mis à jour effectué !"]) ;

        $this->ArticlePage = ARTICLELISTE;
    }

    //Cette fonction permet de nettoyer un fichier temporaire

    protected function cleanupOldUploads(){
        $storage = Storage::disk('local') ;

        foreach($storage->allFiles("livewire-tmp") as $pathFileName){

           if(!$storage->exists($pathFileName)) continue ; // Si le fichier a été supprimer sinon continue

           $fiveSecondeDelete = now()->subSeconds(5)->timestamp;

           if($fiveSecondeDelete > $storage->lastModified($pathFileName)){
               $storage->delete($pathFileName) ;
           }
        }
    }

    //Suppression de l'article

    public function deleteArticle(Article $article){
        //S'il y'a pas de location on le supprime
        if(count($article->locations)>0){
            $this->dispatchBrowserEvent("showDangerMessage",["message" =>
            "Desolé ce article est en cours de Location !"]);
            return ;
        }
        //supression d'abord des rélations qui relient aux à cet article
        if(count($article->article_proprietes)>0)
            $article->article_proprietes()->where("article_id",$article->id)->delete() ;
        if(count($article->tarifications)>0)
            $article->tarifications()->where("article_id",$article->id)->delete() ;
        $article->delete();

        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
        "L'article  supprimé avec succès !"]);
    }
}
