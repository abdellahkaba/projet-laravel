<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("categories")->insert([
            ["nom" => "Traction"],
            ["nom" => "Traitement"],
            ["nom" => "Traval du sol"],
            ["nom" => "Plantation"],
            ["nom" => "Fourrage"],
            ["nom" => "Elevage"],
            ["nom" => "Cereales"],
            ["nom" => "Operation Culturelle"],

        ]);
    }
}
