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
        Schema::create('livros_lidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_leitor");
            $table->unsignedBigInteger("id_livro");
            $table->timestamps();

            // Definindo as chaves estrangeiras
            $table->foreign('id_leitor')->references('id')->on('leitores')->onDelete('cascade');
            $table->foreign('id_livro')->references('id')->on('livros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros_lidos');
    }
};
