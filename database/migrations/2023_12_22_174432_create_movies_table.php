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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('director',100);
            $table->string('sipnosis',300);
            $table->string('cover-art',1000);
            $table->time('duration');
            $table->date('year');
            $table->foreignId('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
