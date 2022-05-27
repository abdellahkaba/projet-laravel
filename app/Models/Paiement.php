<?php

namespace App\Models;

use App\Models\User;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = ["montant","datePaiement","user_id","location_id","created_at,updated_at"];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function locations(){
        return $this->belongsTo(Location::class);
    }


    public function getMontantForHumansAttribute(){
        return number_format($this->montant , 0 , ',',' '). ' ' . env("CURRENCY","FG") ;
    }

}
