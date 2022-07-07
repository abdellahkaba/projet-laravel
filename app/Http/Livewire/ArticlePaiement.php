<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class ArticlePaiement extends Component
{
    public function render()
    {
        return view('livewire.paiements.article', [
            "articles" => Article::whereArticleId($this->article->id)->get(),
        ]
        
        )->extends("master")->section("content");
    }
}
