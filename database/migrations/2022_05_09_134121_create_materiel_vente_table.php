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
        Schema::create('materiel_vente', function (Blueprint $table) {
            $table->id();
            $table->foreignId("materiel_id")->constrained("materiels");
            $table->foreignId("vente_id")->constrained("ventes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("materiel_vente",function(Blueprint $table){
            $table->dropForeign(["materiel_id","vente_id"]) ;
        }); 
        Schema::dropIfExists('materiel_vente');
    }
};
