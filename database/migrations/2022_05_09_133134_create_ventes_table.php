<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->dateTime("dateAchat");
            $table->foreignId("client_id")->constrained("clients");
            $table->foreignId("user_id")->constrained("users");
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints() ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("ventes" , function(Blueprint $table){
            $table->dropForeign(["client_id","user_id"]) ;
        }) ;
        Schema::dropIfExists('ventes');
    }
};
