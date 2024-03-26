<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editoras extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'telefone',
    ];

    public static function editoraExiste($id)
    {
        return Editoras::where('id', $id)->exists();
    }
}
