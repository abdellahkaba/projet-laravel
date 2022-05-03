<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlePropriete extends Model
{
    use HasFactory;

    public $table = "article_propriete";
    protected $fillable = [
        "propriete_article_id",
        "article_id" , "valeur"
    ];
}
