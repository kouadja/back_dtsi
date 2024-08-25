<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id('id_article'); // Colonne ID
            $table->string('nom_article'); // Nom de l'article
            $table->text('description_article')->nullable(); // Description de l'article, nullable
            $table->integer('quantite_article'); // Quantité de l'article
            $table->string('etat_article')->nullable(); // État de l'article (true/false)
            $table->timestamps(); // Ajoute les colonnes created_at et updated_at

            $table->unsignedBigInteger('id_store_keeper')->nullable(); // Colonne pour clé étrangère
            $table->foreign('id_store_keeper')->references('id_store_keeper')->on('store_keepers')->onDelete('cascade'); // Clé étrangère
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
