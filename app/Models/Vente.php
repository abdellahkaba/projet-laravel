<?php

namespace App\Models;

use App\Models\User;
use App\Models\Materiel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vente extends Model
{
    use HasFactory;


    public function materiels(){
        return $this->belongsToMany(Materiel::class,"materiel_vente","vente_id","materiel_id");
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
