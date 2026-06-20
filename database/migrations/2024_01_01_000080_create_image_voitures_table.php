<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('image_voitures', function (Blueprint $table) {
            $table->id('id_image');
            $table->unsignedBigInteger('id_voiture');
            $table->string('url');
            $table->integer('ordre')->default(0);
            $table->timestamps();

            $table->foreign('id_voiture')->references('id')->on('voitures')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_voitures');
    }
};
