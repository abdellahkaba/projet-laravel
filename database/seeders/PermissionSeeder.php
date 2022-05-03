<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("permissions")->insert([
            ["nom" => "ajouter un client"],
            ["nom" => "editer un client"],
            ["nom" => "consulter un client"],
            ["nom" => "ajouter un article"],
            ["nom" => "editer un article"],
            ["nom" => "consulter un article"],
            ["nom" => "ajouter une location"],
            ["nom" => "editer une location"],
            ["nom" => "consulter une location"],
        ]);
    }
}
