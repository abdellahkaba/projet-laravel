<?php

namespace App\Models;

use App\Models\Article;
use App\Models\DureeLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarification extends Model
{
    use HasFactory;

    protected $fillable = ["prix","duree_location_id","article_id","created_at","updated_at"];

    public function dureeLocation(){
        return $this->belongsTo(DureeLocation::class);
    }
    public function article(){
        return $this->belongsTo(Article::class);
    }

    public function getPrixForHumansAttribute(){
        return number_format($this->prix , 0 , ',',' '). ' ' . env("CURRENCY","FG") ;
    }
}
