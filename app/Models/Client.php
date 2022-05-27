<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    //protected $guarded = [] ;

    protected $fillable = ["nom","prenom", "sexe" ,"dateNaiss","lieuNaiss", "ville","telephone","adresse","created_at","updated_at"] ;

    public function locations(){
        return $this->hasMany(Location::class);
    }
}
