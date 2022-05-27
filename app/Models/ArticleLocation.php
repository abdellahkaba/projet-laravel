<?php

namespace App\Models;

use App\Models\Location;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleLocation extends Model
{
    use HasFactory;
    public $table = "article_location";
    protected $fillable = ["article_id","location_id","created_at","updated_at"] ;

    public function locations(){
        return $this->hasMany(Location::class, "id" ,"location_id");
    }
    public function article(){
        return $this->hasMany(Article::class,"id","article_id");
    }

}

