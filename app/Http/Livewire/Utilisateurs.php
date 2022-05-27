<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;

use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Utilisateurs extends Component
{

    use WithPagination ;
    public $search = "";

    protected $paginationTheme = 'bootstrap';
    public $isbtnaddClick = false ; //verifier si le nouvel user a été ajouté

    public $newUser = [] ;

    public $editUser = [] ;

    public $currentPage = PAGELISTE ;

    public $rolesPermissions = [] ;

    public function rules(){
        if($this->currentPage == PAGEEDITFORM){
            return [
                'editUser.nom' => 'required',
                'editUser.prenom' => 'required',
                'editUser.sexe' => 'required',
                'editUser.telephone' => ['required','numeric',Rule::unique("users","telephone")->ignore($this->editUser['id'])],
                'editUser.adresse' => 'required',
                'editUser.email' => ['required','email',Rule::unique("users","email")->ignore($this->editUser['id'])],
            ];
        }

        return [
            'newUser.nom' => 'required',
            'newUser.prenom' => 'required',
            'newUser.sexe' => 'required',
            'newUser.telephone' => 'required|numeric|unique:users,telephone',
            'newUser.adresse' => 'required',
            'newUser.email' => 'required|email|unique:users,email',
        ];
    }

    protected $messages = [
        'newUser.nom.required' => 'Saisir le nom.',
        'newUser.prenom.required' => 'Saisir le prenom.',
        'newUser.sexe.required' => 'selectionner un sexe.',
        'newUser.telephone.required' => 'Donner un contact.',
        'newUser.email.required' => 'Saisir l\'adresse email.',
        'newUser.adresse.required' => 'Saisir l\'adresse.',
    ];



    public function render(){

        Carbon::setLocale("fr"); //Traduction de la page en français
        $rechercherParNom = "%".$this->search."%";
        $users = User::where("nom","like",$rechercherParNom)->latest()->paginate(8);
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
       $validationAttributes["newUser"]["password"] = "password";


       User::create($validationAttributes["newUser"]);
       $this->newUser = [];

      //$this->validate();
     // dump($validationAttributes) ;

       $this->dispatchBrowserEvent("showMessageSuccess",["message","Utilisateur crée avec succès"]);
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
    }

    //confirmation de la suppression
    public function confirmDelete($id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message" =>
        [
            "text" => "Vous êtes sur le point de supprimer cet Utilisateur
             Voulez-vous continuer ? ",
            "title" => "Êtes-vous sûr de continuer ? ",
            "type" =>"warning",
            "data" => [
                "user_id" => $id
            ]
        ]
        ]);
    }

    //function de suppression
    public function deleteUser($id){
        User::destroy($id);
        $this->dispatchBrowserEvent("showSuccessMessage",["message" =>
         "L'utilisateur supprimé avec succès !"]);
    }
}
