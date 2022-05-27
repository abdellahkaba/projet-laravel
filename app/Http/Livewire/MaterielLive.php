<?php

namespace App\Http\Livewire;


use Carbon\Carbon;
use Livewire\Component;
use App\Models\Materiel;
use App\Models\Categorie;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MaterielLive extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search = "";
    public $filtreCategorie = "";
    public $filtreEtat = "" ;
    public $addMateriel = [] ;
    public $addPhoto = null ;
    public $editPhoto = null ;
    public $editMateriel = [] ;
    public $editChanged = false ;
    public $editMaterielValue = [] ;
    public $pageMateriel = MATERIELLISTE ;

    //validation pour l'edition de matériel

    public function rules(){
        if($this->pageMateriel == MATERIELEDIT){
            return [
                'editMateriel.nom' => ['required' , Rule::unique("materiels,nom")->ignore($this->editMateriel["id"])],
                'editMateriel.categorie_id' => 'required|exists:App\Models\Categorie",id',
            ];
        }
    }

    public function render()
    {
        Carbon::setLocale("fr");
        $materielQuery = Materiel::query();
        if($this->search != ""){
            $materielQuery->where("nom","LIKE","%".$this->search. "%");
        }

        //Filtre par de categorie matériel
        if($this->filtreCategorie != ""){
            $materielQuery->where("categorie_id",$this->filtreCategorie);
        }
        //Filtre par Etat de disponibilité
        if($this->filtreEtat !=""){
            $materielQuery->where("estDisponible",$this->filtreEtat);
        }

        if($this->editMateriel != []){
            $this->showUpdateButton();
        }
        return view('livewire.materiels.index' , [
            "materiels" =>$materielQuery->latest()->paginate(3),
            "categories" => Categorie::orderBy("nom","ASC")->get()
        ])
        ->extends('layouts.master')
        ->section('content');
        ;
    }

    //page d'ajout Categorie
    public function gotoAddMateriel(){
        $this->addMateriel = [] ;
        $this->pageMateriel = MATERIELCREATE ;
    }

    //Ajout d'un article

    public function addMateriel(){
        $validated = $this->validate([
            "addMateriel.nom" => "string|min:3|required|unique:materiels,nom",
            "addMateriel.categories" => "required",
            "addPhoto" => 'image|max:10240'
        ]);

        //Insertion de l'image
        $imagePath = "images/imageplaceholder.png";
        if($this->addPhoto != null){
            $path = $this->addPhoto->store("upload","public");
            $imagePath = "storage/".$path;
            $image = Image::make(public_path($imagePath))->fit(205,205);

            $image->save() ;
        }
        Materiel::create([
            "nom" => $validated["addMateriel"]["nom"],
            "categorie_id" => $validated["addMateriel"]["categories"],
            "photo" => $imagePath
        ]);
        


        $this->dispatchBrowserEvent("showSuccessMessage" , ["message", "Materiel ajouté avec success ! "]) ;

       $this->addMateriel = [] ;
       $this->pageMateriel = MATERIELLISTE; 
    }

    public function gotoListMateriel(){
        $this->pageMateriel = MATERIELLISTE;
        $this->addPhoto = null ;
        $this->addMateriel = [] ;
    }

    //
    public function showUpdateButton(){
        $this->editChanged = false;
        if(
            $this->editMateriel["nom"] != $this->editMaterielValue["nom"] ||
            $this->editPhoto != null

        ) {
            $this->editChanged = true ;
        }
        $this->editChanged;
    }

    public function editMateriel($materielid){
        $this->pageMateriel = MATERIELEDIT;

        $this->editMateriel = Materiel::with("ventes","categories")->find($materielid)->toArray();

        $this->editMaterielValue = $this->editMateriel;
        $this->editPhoto = null ;
    }

     //confirmation delete d'article
     public function confirmDelete($id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" =>
        [
                "text" => "Vous êtes sur le point de supprimer cet materiel  de la liste des Matériels
                Voulez-vous continuer ? ",
                "title" => "Êtes-vous sûr de continuer ? ",
                "type" =>"warning",
                "data" => [
                    "materiel_id" => $id
                ]
            ]
        ]);

    }

    //function de Modification

    public function updateMateriel(){
        //L'article à editer
        // $this->validate() ;
        $materiel = Materiel::find($this->editMateriel["id"]);

        $materiel->fill($this->editMateriel);

        if($this->editPhoto != null){
            $path = $this->editPhoto->store("upload","public");
            $imagePath = "storage/".$path ;

            $image = Image::make(public_path($imagePath))->fi(205,205) ; $image->save() ;

            //superession de l'ancienne image par la nouvelle

            Storage::disk("local")->delete(str_replace("storage/",  "public",$materiel->photo())) ;

            $materiel->photo = $imagePath ;
        }

        $materiel->save();

        $this->dispatchBrowserEvent("showSuccessMessage",["message" => "Materiel Mis à jour effectué !"]) ;
        $this->pageMateriel = MATERIELLISTE;
    }


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

    public function deleteMateriel(Materiel $materiel){
        //S'il y'a pas de vente on le supprime
        if(count($materiel->ventes)>0) return ;        
        $materiel->delete();
             
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
        "Materiel non !"]);
    }
}
