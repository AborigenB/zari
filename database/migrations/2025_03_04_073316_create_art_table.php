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
        Schema::create('art', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('artist');
            $table->string('title');
            $table->string('size');
            $table->year('age');
            $table->longText('description');
            $table->decimal('price',8,2);
            $table->enum('status',['Опубликован','Не опубликовано','Продано'])->default('Не опубликовано');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('art');
    }
};
