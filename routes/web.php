<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Livewire\ArticleLive;
use App\Http\Livewire\CategorieLive;
use App\Http\Livewire\MaterielLive;
use App\Http\Livewire\TypeArticleLive;
use App\Http\Livewire\Utilisateurs;

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    "middleware" =>["auth","admin"],
    "as" => "admin.",
], function(){
    Route::group([
        "prefix"=> "habilitations",
        "as" => "habilitations."
    ],function(){
        //Mapper la route à un composant livewire et accession par une route
        Route::get("/utilisateurs",Utilisateurs::class)->name("users.index");
    });
    Route::group([
        "prefix"=> "gestarticles",
        "as" => "gestarticles."
    ],function(){
        //Mapper la route à un composant livewire et accession par une route
        Route::get("/types",TypeArticleLive::class)->name("types");
        Route::get("/articles",ArticleLive::class)->name("articles");
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
// Route::get('/habilitations/utilisateurs', [UserController::class,'index'])->name('utilisateurs');
