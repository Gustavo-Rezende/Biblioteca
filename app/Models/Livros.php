<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livros extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_editora',
        'nome',
        'genero',
        'autor',
        'ano',
        'paginas',
        'idioma',
        'edicao',
        'isbn',
    ];

}
