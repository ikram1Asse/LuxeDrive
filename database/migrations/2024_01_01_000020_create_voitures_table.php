<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->string('modele');
            $table->year('annee');
            $table->decimal('prix', 12, 2);
            $table->integer('kilometrage');
            $table->string('carburant');
            $table->integer('horsepower')->nullable();
            $table->string('drivetrain')->nullable();
            $table->string('transmission');
            $table->string('couleur');
            $table->text('description')->nullable();
            $table->enum('statut', ['Disponible', 'Réservée', 'Vendue'])->default('Disponible');
            $table->string('image_principale')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voitures');
    }
};
