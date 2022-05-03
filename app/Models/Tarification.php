<?php

namespace App\Models;

use App\Models\Article;
use App\Models\DureeLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarification extends Model
{
    use HasFactory;

    public function duree_location(){
        return $this->belongsTo(DureeLocation::class);
    }
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
