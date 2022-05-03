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
            ["nom" => "Femmes"],
            ["nom" => "Hommes"],
            
        ]);
    }
}
