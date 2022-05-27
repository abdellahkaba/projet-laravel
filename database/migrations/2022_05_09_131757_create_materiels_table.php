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
        Schema::create('materiels', function (Blueprint $table) {
            $table->id();
            $table->string("nom")->unique();
            // $table->string("description");
            $table->boolean('estDisponible')->default(1);
            $table->string("photo");
            $table->foreignId("categorie_id")->constrained("categories");
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("materiels" , function(Blueprint $table){
            $table->dropForeign("categorie_id");
        });
        Schema::dropIfExists('materiels');
    }
};
