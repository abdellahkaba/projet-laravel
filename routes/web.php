<?php

use App\Http\Controllers\MailController;
use App\Http\Livewire\ClientLive;
use App\Http\Livewire\ArticleLive;
use App\Http\Livewire\LocationList;
use App\Http\Livewire\LocationLive;
use App\Http\Livewire\MaterielLive;
use App\Http\Livewire\PaiementList;
use App\Http\Livewire\PaiementLive;
use App\Http\Livewire\Utilisateurs;
use App\Http\Livewire\CategorieLive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TypeArticleLive;
use App\Http\Livewire\TarificationLive;
use App\Http\Controllers\UserController;
use App\Http\Livewire\LocationArticle;
use App\Http\Livewire\LocationEncour;
use App\Http\Livewire\MailLive;
use App\Http\Livewire\PrintLocation;
use App\Http\Livewire\TarificationComp;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::group([
    "middleware" => ["superadmin"],
    "as" => "superdamin.",
],function(){
    Route::group([
        "prefix"=> "habilitations",
        "as" => "habilitations."
    ],function(){
        //Mapper la route à un composant livewire et accession par une route
        Route::get("/utilisateurs",Utilisateurs::class)->name("users.index");


    });
}
);
Route::group([
    "middleware" =>["auth","admin"],
    "as" => "admin.",
], function(){
    // Route::group([
    //     "prefix"=> "habilitations",
    //     "as" => "habilitations."
    // ],function(){
    //     //Mapper la route à un composant livewire et accession par une route
    //     Route::get("/utilisateurs",Utilisateurs::class)->name("users.index");
    // });
    Route::group([
        "prefix"=> "gestarticles",
        "as" => "gestarticles."
    ],function(){
        //Mapper la route à un composant livewire et accession par une route
        // Route::get("mails",'MailController@create')->name('emails.create');
        // Route::post("mails",'MailController@store') ;
        Route::get("mails",MailLive::class)->name('emails.create');
        Route::post("mails",MailLive::class)->name('emails.store');
        Route::get("/",LocationEncour::class)->name("locations.kaba");
        Route::get("/types",TypeArticleLive::class)->name("types");
        Route::get("/articles",ArticleLive::class)->name("articles");
        Route::get("/articles/{articleId}/tarifs",TarificationLive::class)->name("articles.tarifs");
        Route::get("/tarification",TarificationComp::class)->name("articles.tarification") ;
        Route::get("/articles/{articleId}/location",LocationLive::class)->name("articles.location");

        Route::get("/locations",LocationList::class)->name("locations.locationliste");
        Route::get("/locations",PrintLocation::class)->name("locations.printliste");
        // Route::get("/mails",MailLive::class)->name("mails.create");
        // Route::post("/mails",MailLive::class)->name("mails.store");



        // Route::get("/articles",PaiementList::class)->name("articles.paiments") ;
    });
    Route::group([
        "prefix" =>"gestmateriels",
        "as" =>"gestmateriels."
    ], function(){
        //Mapper la route à un composant liveWire Materiels
        Route::get("/categories",CategorieLive::class)->name("categories");
        Route::get("/materiels",MaterielLive::class)->name("materiels");
    });
});

Route::group([
    "middleware" =>["auth","employe"],
    "as" => "employe.",
],function(){
    Route::group([
        "prefix"=> "locations",
        "as" => "locations."
    ],function(){

        Route::get("/locations",LocationLive::class)->name("locations.index");
        Route::get("/locations/encour",LocationEncour::class)->name("locations.encour");
        Route::get("/locations",LocationList::class)->name("locations.locationliste");
        Route::get("/locations/{locationId}/paiements",PaiementLive::class)->name("locations.paiements");
        Route::get("/articles",ArticleLive::class)->name("articles");
        Route::get("/locations",LocationArticle::class)->name("locations.create");
        Route::get("/articles/{articleId}/location",LocationLive::class)->name("articles.location");
        Route::get("/articles/{articleId}/tarifs",TarificationLive::class)->name("articles.tarifs");
        Route::get("/tarification",TarificationComp::class)->name("articles.tarification") ;
        Route::get("/",LocationEncour::class)->name("locations.kaba");
        // Route::get("/mails",MailLive::class)->name("mails.create");

    });
    Route::group([
        "prefix" => "clients",
        "as" => "clients."
    ],function(){
        Route::get("/clients",ClientLive::class)->name("clients.index");
    });


}
);
