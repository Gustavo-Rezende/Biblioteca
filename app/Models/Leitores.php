<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leitores extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco',
        'data_aniversario',
    ];

    public static function buscarLeitoresPorDataAniversario(){
        $dia = date('d');
        $mes = date('m');
        return  DB::table('leitores')
        ->select('*')
        ->whereMonth('data_aniversario', '=', $dia)
        ->whereDay('data_aniversario', '=', $mes)
        ->get();
    }
}
