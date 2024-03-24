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
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_editora');
            $table->string('nome');
            $table->string('genero');
            $table->string('autor');
            $table->string('ano')->nullable();
            $table->string('paginas');
            $table->string('idioma');
            $table->string('edicao');
            $table->bigInteger('isbn');
            $table->timestamps();

            // Definindo a chave estrangeira
            $table->foreign('id_editora')->references('id')->on('editoras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
