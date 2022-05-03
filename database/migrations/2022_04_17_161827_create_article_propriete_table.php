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
        Schema::create('article_propriete', function (Blueprint $table) {
            $table->id();
            $table->foreignId("propriete_article_id")->constrained("propriete_articles");
            $table->foreignId("article_id")->constrained("articles");
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
        Schema::table('article_propriete',function(Blueprint $table){
            $table->dropForeign(["propriete_article_id","article_id"]);
        });
        Schema::dropIfExists('article_propriete');
    }
};
