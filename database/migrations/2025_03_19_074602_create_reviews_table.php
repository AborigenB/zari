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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('art_id')->constrained()->onDelete('cascade');
            $table->string('title', 120);
            $table->text('description');
            $table->tinyInteger('score1')->unsigned();
            $table->tinyInteger('score2')->unsigned();
            $table->tinyInteger('score3')->unsigned();
            $table->tinyInteger('score4')->unsigned();
            $table->tinyInteger('score5')->unsigned();
            $table->tinyInteger('score6')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
