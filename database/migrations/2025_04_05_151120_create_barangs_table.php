<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->string('nama'); 
            $table->integer('harga'); 
            $table->integer('jumlah');
            $table->string('foto')->nullable();
            $table->timestamps();

    
            $table->foreign('kategori_id')
                  ->references('id')->on('kategoris')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};