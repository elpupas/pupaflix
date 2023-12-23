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
        Schema::create('rate_movies', function (Blueprint $table) {
            
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('movie_id');
            $table->tinyInteger('like')->nullable();
            $table->string('comment')->nullable();
            $table->enum('rate', ['1', '2', '3', '4', '5'])->nullable();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');

            // Clave primaria compuesta para evitar duplicados de la misma relación
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_movies');
    }
};
