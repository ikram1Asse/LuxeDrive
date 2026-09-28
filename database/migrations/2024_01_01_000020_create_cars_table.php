<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->year('year');
            $table->decimal('price', 12, 2);
            $table->integer('mileage');
            $table->string('fuel');
            $table->integer('horsepower')->nullable();
            $table->string('drivetrain')->nullable();
            $table->string('transmission');
            $table->string('color');
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'reserved', 'sold'])->default('available');
            $table->string('main_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
