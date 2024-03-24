<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LivrosLidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_livro',
        'id_leitor',
    ];

    public static function obterTotaisLivrosLidosPorAno($ano){
        return self::join('livros as l', 'livros_lidos.id_livro', '=', 'l.id')
        ->select('livros_lidos.id_leitor', DB::raw('COUNT(livros_lidos.id_leitor) as totalLidos'), DB::raw('SUM(l.paginas) as totalPaginas'))
        ->whereYear('livros_lidos.created_at', $ano)
        ->groupBy('livros_lidos.id_leitor')
        ->get();
    }
}
