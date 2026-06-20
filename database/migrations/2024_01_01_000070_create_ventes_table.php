<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id('id_vente');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_voiture');
            $table->unsignedBigInteger('id_employe');
            $table->date('date_vente');
            $table->decimal('prix_final', 12, 2);
            $table->enum('mode_paiement', ['especes', 'carte', 'virement']);
            $table->enum('statut', ['en_cours', 'finalise', 'annule'])->default('en_cours');
            $table->text('commentaire')->nullable();
            $table->timestamps();

            $table->foreign('id_client')->references('id_client')->on('clients')->onDelete('cascade');
            $table->foreign('id_voiture')->references('id')->on('voitures')->onDelete('cascade');
            $table->foreign('id_employe')->references('id')->on('employes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
