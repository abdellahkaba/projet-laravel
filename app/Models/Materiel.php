<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vente;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materiel extends Model
{
    use HasFactory;
    protected $fillable = ["nom","estDisponible", "photo" , "categorie_id","created_at","updated_at"] ;
    public function categories(){
        return $this->belongsTo(Categorie::class , "categorie_id","id");
    }

    public function ventes(){
        return $this->belongsToMany(Vente::class, "materiel_vente", "materiel_id","vente_id");
    }

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }


    // public function categories(){
    //     return $this->belongsToMany(Categorie::class,"article_propriete","article_id","propriete_article_id");
    // }
}
