<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_models', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->string('statutTache')->default('en_attente');
            $table->string('technicienAssigner')->nullable();
            $table->string('lieuTache');
            $table->string('priorité')->default('moyenne');
            $table->date('dateDebut')->nullable();
            $table->date('dateFin')->nullable();
            $table->string('statut')->default('en_attente');
            $table->date('datedemande')->default(DB::raw('CURRENT_DATE'));
            $table->text('solutionProposee')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_models');
    }
};
