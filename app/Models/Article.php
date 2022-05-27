<?php

namespace App\Models;

use App\Models\Location;
use App\Models\Categorie;
use App\Models\TypeArticle;
use App\Models\Tarification;
use App\Models\ArticlePropriete;
use App\Models\ProprieteArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ["nom","noSerie","imageUrl","estDisponible","type_article_id","created_at","updated_at"] ;
    public function type(){
        return $this->belongsTo(TypeArticle::class , "type_article_id","id");
    }

    public function tarifications(){
          return $this->hasMany(Tarification::class);
    }

    public function locations(){
          return $this->hasMany(Location::class);
    }


    public function proprietes(){
          return $this->belongsToMany(ProprieteArticle::class,"article_propriete","article_id","propriete_article_id");
    }

    public function article_proprietes(){
      return $this->hasMany(ArticlePropriete::class);
    }
}
