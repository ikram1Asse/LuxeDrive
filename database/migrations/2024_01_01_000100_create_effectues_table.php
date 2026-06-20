<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('effectues', function (Blueprint $table) {
            $table->id('id_effectue');
            $table->unsignedBigInteger('id_vente');
            $table->unsignedBigInteger('id_employe');
            $table->timestamps();

            $table->foreign('id_vente')->references('id_vente')->on('ventes')->onDelete('cascade');
            $table->foreign('id_employe')->references('id')->on('employes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('effectues');
    }
};
