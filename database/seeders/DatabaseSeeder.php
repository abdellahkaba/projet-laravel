<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Article;
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
         \App\Models\User::factory(15)->create();
         $this->call(RoleTableSeeder::class);
         $this->call(TypeArticleSeeder::class);
         $this->call(StatutLocationSeeder::class);
         $this->call(PermissionSeeder::class);
         $this->call(DureeLocationSeeder::class);
         Article::factory(11)->create();
         Client::factory(10)->create();
         $this->call(CategorieTableSeeder::class);
         Materiel::factory(15)->create();

        // Article::find(1)->type_articles()->attach(1);
        // Article::find(2)->type_articles()->attach(2);
        // Article::find(3)->type_articles()->attach(3);
        // Article::find(4)->type_articles()->attach(4);

         User::find(2)->roles()->attach(2);
         User::find(3)->roles()->attach(4);
         User::find(1)->roles()->attach(4);
         User::find(1)->roles()->attach(2);
         User::find(2)->roles()->attach(1);
         User::find(4)->roles()->attach(2);

        //  User::find(1)->permissions()->attach(1);
        //  User::find(2)->permissions()->attach(2);
        //  User::find(3)->permissions()->attach(3);
        //  User::find(4)->permissions()->attach(4);
        //  User::find(1)->permissions()->attach(3);
        //  User::find(2)->permissions()->attach(4);
        //  User::find(3)->permissions()->attach(2);
        //  User::find(4)->permissions()->attach(1);

    }
}
