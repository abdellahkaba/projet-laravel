<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Article;
use App\Models\Location;
use App\Models\Materiel;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleTableSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\TypeArticleSeeder;
use Database\Seeders\DureeLocationSeeder;
use Database\Seeders\CategorieTableSeeder;
use Database\Seeders\StatutLocationSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(1)->create();
         $this->call(RoleTableSeeder::class);
         $this->call(TypeArticleSeeder::class);
         $this->call(StatutLocationSeeder::class);
         $this->call(PermissionSeeder::class);

        // Article::factory(10)->create();
        // Client::factory(10)->create();
        //  $this->call(CategorieTableSeeder::class);
        //  Materiel::factory(15)->create();
        //  Location::factory(17)->create();

         User::find(1)->roles()->attach(1);
        // User::find(2)->roles()->attach(2);
        // User::find(3)->roles()->attach(3);
        //  User::find(1)->roles()->attach(2);
        //  User::find(2)->roles()->attach(1);
        //  User::find(4)->roles()->attach(2);

        //  User::find(1)->permissions()->attach(1);


    }
}
