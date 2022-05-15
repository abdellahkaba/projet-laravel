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
        Schema::create('materiel_categorie', function (Blueprint $table) {
            $table->id();
            $table->foreignId("categorie_id")->constrained("categories");
            $table->foreignId("materiel_id")->constrained("materiels");
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
        Schema::table('materiel_categorie', function(Blueprint $table){
            $table->dropForeign(["categorie_id","materiel_id"]) ;
        });
        Schema::dropIfExists('materiel_categorie');
    }
};
