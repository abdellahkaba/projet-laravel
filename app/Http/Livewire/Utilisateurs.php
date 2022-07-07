<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;

use App\Models\Image;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Utilisateurs extends Component
{

    use WithPagination ;
    public $search = "";

    protected $paginationTheme = 'bootstrap';
    public $isbtnaddClick = false ; //verifier si le nouvel user a été ajouté

    public $newUser = [] ;

    public $editUser = [] ;
    public $editPhoto = null;
    public $addPhoto = null ;

    public $currentPage = PAGELISTE ;

    public $rolesPermissions = [] ;

    public function rules(){
        if($this->currentPage == PAGEEDITFORM){
            return [
                'editUser.prenom' => 'required',
                'editUser.nom' => 'required',
                'editUser.dateNaiss' => 'required',
                'editUser.lieuNaiss' => 'required',
                'editUser.sexe' => 'required',
                'editUser.telephone' => ['required','numeric',Rule::unique("users","telephone")->ignore($this->editUser['id'])],
                'editUser.adresse' => 'required',
                'editUser.email' => ['required','email',Rule::unique("users","email")->ignore($this->editUser['id'])],
            ];
        }
        return [
            'newUser.prenom' => 'required',
            'newUser.nom' => 'required',
            'newUser.dateNaiss' => 'required',
            'newUser.lieuNaiss' => 'required',
            'newUser.sexe' => 'required',
            'newUser.telephone' => 'required|numeric|unique:users,telephone',
            'newUser.adresse' => 'required',
            'newUser.email' => 'required|email|unique:users,email',
            //  "addPhoto" => 'image|max:10240',
            'newUser.path' => '',
            // 'newUser.password' => 'required|password|unique:users,password',
        ];
    }

    protected $messages = [
        'newUser.prenom.required' => 'Saisir le prenom.',
        'newUser.nom.required' => 'Saisir le nom.',
        'newUser.dateNaiss.required' => 'Saisir le prenom.',
        'newUser.lieuNaiss.required' => 'Saisir le prenom.',
        'newUser.sexe.required' => 'selectionner un sexe.',
        'newUser.telephone.required' => 'Donner un contact.',
        'newUser.email.required' => 'Saisir l\'adresse email.',
        'newUser.adresse.required' => 'Saisir l\'adresse.',
        
        // 'newUser.password.required' => 'Saisir le mot de pass.',
    ];



    public function render(){

        Carbon::setLocale("fr"); //Traduction de la page en français
        $rechercherParNom = "%".$this->search."%";
        $users = User::where("nom","like",$rechercherParNom)->orWhere("prenom","LIKE","%".  $rechercherParNom ."%")->latest()->paginate(8);
        return view('livewire.utilisateurs.index' , ["users" => $users])
            ->extends('layouts.master')
            ->section('content');
    }



    public function gotoaddUser(){
        $this->currentPage = PAGECREATEFORM;
    }

    public function gotoListUser(){
        $this->currentPage = PAGELISTE;
        $this->editUser = [];
    }

    public function gotoEditUser($id){
        $this->editUser = User::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
        $this->populateRolePermissions();
    }

    public function populateRolePermissions(){
        $this->rolesPermissions["roles"] = [] ;
        $this->rolesPermissions["permissions"] = [] ;
        $mapForCB = function($value){
            return $value["id"];
        } ;
        $rolesId = array_map( $mapForCB ,User::find($this->editUser["id"])->roles->toArray());
        $permissionsId = array_map( $mapForCB ,User::find($this->editUser["id"])->roles->toArray());


        foreach(Role::all() as $role){
            if(in_array($role->id , $rolesId)){
                array_push($this->rolesPermissions["roles"] , ["role_id" =>$role->id , "role_nom" =>$role->nom , "active" => true]) ;
            }else{
                array_push($this->rolesPermissions["roles"] , ["role_id" =>$role->id , "role_nom" =>$role->nom , "active" => false]) ;
            }
           // dump($this->rolesPermissions);
        }

        foreach(Permission::all() as $permission){
            if(in_array($permission->id , $permissionsId)){
                array_push($this->rolesPermissions["permissions"] , ["permission_id" =>$permission->id , "permission_nom" =>$permission->nom , "active" => true]) ;
            }else{
                array_push($this->rolesPermissions["permissions"] , ["permission_id" =>$permission->id , "permission_nom" =>$permission->nom , "active" => false]) ;
            }
           // dump($this->rolesPermissions);
        }
    }

    public function updateRoleAndPermission(){
        DB::table("user_role")->where("user_id", $this->editUser["id"])->delete();
        DB::table("user_permission")->where("user_id", $this->editUser["id"])->delete();

        foreach($this->rolesPermissions["roles"] as $role){
            if($role["active"]){
                User::find($this->editUser["id"])->roles()->attach($role["role_id"]) ;
            }
        }

        foreach($this->rolesPermissions["permissions"] as $permission){
            if($permission["active"]){
                User::find($this->editUser["id"])->permissions()->attach($permission["permission_id"]) ;
            }

        }

        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
        "Role et Permission mis à jour avec succès !"]);
    }

    public function addUser(){
       $validationAttributes = $this->validate();
       $validationAttributes["newUser"]["password"] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
       $validationAttributes["newUser"]["email_verified_at"] = now() ;
    //    $imagePath = "images/imageplaceholder.png" ;
    //     if($this->addPhoto != null){
    //       $path = $this->addPhoto->store('upload', 'public');
    //       $imagePath = "storage/".$path ;
    //       $image = Image::make(public_path($imagePath))->fit(204,204) ;
    //       $image->save() ;
    //     }
    //     $validationAttributes['newUser']["photo"] = $imagePath ;
        User::create(
            $validationAttributes["newUser"]
        );
        $this->newUser = [];
     $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
     "Utilisateur Ajouté avec succèss ! "]);

     $this->currentPage = PAGELISTE;
    }

    public function confirmAdd(){
        $this->dispatchBrowserEvent("show",["message" => "Utilisateur créee avec succès !"]);
    }

    public function confirmPwdReset(){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" =>[
            "text" => "Voulez-vous reinitialiser ce Mdp ? ",
            "title" => "Êtes vous sûr ? " ,
            "type" => "warning",

        ]]);

    }

    public function resetPassword(){
        User::find($this->editUser["id"])->update(["password"=> Hash::make(DEFAULTPASSWORD)]);
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
        "Mot de pass reinitialiser avec succès !"]);

    }
    //Modification

    public function updateUser(){
        $validationAttributes = $this->validate();
        User::find($this->editUser['id'])->update($validationAttributes["editUser"]);
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
         "Utilisateur mis à jour avec succès ! "]);

         $this->currentPage = PAGELISTE;
    }

    //confirmation de la suppression
    public function confirmDelete(User $user){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" =>
        [
            "text" => "Vous êtes sur le point de supprimer cet Utilisateur
             Voulez-vous continuer ? ",
            "title" => "Êtes-vous sûr de continuer ? ",
            "type" =>"warning",
            "data" => [
                "user_id" => $user
            ]
        ]
        ]);
    }

    //function de suppression
    public function deleteUser(User $user){
        if(count($user->paiement)>0){
            $this->dispatchBrowserEvent("showDangerMessage",["message" =>
            "Desolé ce Utilisateur est lié à un paiement effectué,
            Veuillez supprimer cela d'abord !"]);
            return ;
        }
        $user->delete();
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
         "L'utilisateur supprimé avec succès !"]);
    }
}
