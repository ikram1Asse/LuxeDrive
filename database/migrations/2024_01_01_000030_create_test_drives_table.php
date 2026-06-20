<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_drives', function (Blueprint $table) {
            $table->id('id_test_drive');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_voiture');
            $table->date('date_test');
            $table->time('heure_test');
            $table->enum('statut', ['en_attente', 'confirme', 'annule', 'effectue'])->default('en_attente');
            $table->text('commentaire')->nullable();
            $table->timestamps();

            $table->foreign('id_client')->references('id_client')->on('clients')->onDelete('cascade');
            $table->foreign('id_voiture')->references('id')->on('voitures')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_drives');
    }
};
