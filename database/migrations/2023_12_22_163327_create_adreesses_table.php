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
        Schema::create('adreesses', function (Blueprint $table) {
            $table->id();
            $table->string('country', 100);
            $table->foreignId('user_id');
            $table->string('city', 100);
            $table->string('street', 100);
            $table->string('zipcode', 11);
            $table->string('floor');
            $table->string('door', 20);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adreesses');
    }
};
