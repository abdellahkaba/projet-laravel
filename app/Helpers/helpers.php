<?php

use Illuminate\Support\Str;


    define("PAGECREATEFORM","create");
    define("PAGEEDITFORM","edit");
    define("PAGELISTE","liste");
    define("DEFAULTPASSWORD","password") ;

    define("PROPRIETEINDEX" , "index");
    define("PROPRIETEPAGE","propriete");
    
    define("ARTICLECREATE","create");
    define("ARTICLEEDIT","edit") ;
    define("ARTICLELISTE","liste");

    function UserName(){
        return auth()->user()->nom . ' ' . auth()->user()->prenom;
    }

    function setMenuOpenClass($route , $classe){
        $routeActuel = request()->route()->getName();
        if(contains($routeActuel , $route)){
            return $classe ;
        }
        return "";
    }

    function setMenuActive($route){
        $routeActuel = request()->route()->getName();
        if($routeActuel === $route){
            return "active" ;
        }
        return "";
    }


    //fonction qui permet de verifier si l'interieur de cette chaîne de caractere

    function contains($container , $contenu){
        return Str::contains($container, $contenu) ;
    }

    function getRoleName(){
        $rolesName = "" ;
        $i = 0 ;
        foreach(auth()->user()->roles as $role){
            $rolesName .= $role->nom ;

            if($i < sizeof(auth()->user()->roles) -1){
                $rolesName .= ",";
            }
            $i++ ;
        }
        return $rolesName;
    }
?>
