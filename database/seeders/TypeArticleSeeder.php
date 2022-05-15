<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("type_articles")->insert([
            ["nom" => "Voiture"],
            ["nom" => "Salle"],
            ["nom" => "Appareils Electroniques"],
            ["nom" => "Immobilier"],
            ["nom" => "Vetement"],
            ["nom" => "Maisons"],
            ["nom" => "Engins"],
            ["nom" => "Chaises"],
            ["nom" => "Documents"],


        ]);

        DB::table("propriete_articles")->insert([
            ["nom" => "Marque" , "type_article_id" => 1],
            ["nom" => "Prix" , "type_article_id" => 3],
            ["nom" => "Couleur" , "type_article_id" => 5],
            ["nom" => "Prix" , "type_article_id" => 1],
            ["nom" => "Kilometrage" , "type_article_id" => 1],
            ["nom" => "Marque" , "type_article_id" => 3],
            ["nom" => "Dimession" , "type_article_id" => 2],
            ["nom" => "Qualite" , "type_article_id" => 2],
            ["nom" => "Reference" , "type_article_id" => 4],
            ["nom" => "Vitesse" , "type_article_id" => 1],
            ["nom" => "Couleur" , "type_article_id" => 8]
        ]);
    }
}
