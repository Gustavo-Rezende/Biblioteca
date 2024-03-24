<?php

namespace App\Http\Controllers;

use App\Models\Livros;
use App\Models\Leitores;
use App\Models\LivrosLidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PaginasLivroController extends Controller
{

    public function armazenarTotalLivroslidosPorLeitor($ano)
    {

        $resultado = LivrosLidos::obterTotaisLivrosLidosPorAno($ano);

        foreach($resultado as $key => $valores) {

            $totalizadores = array('totalLidos'=>$valores->totalLidos,
                                    'totalPaginas'=>$valores->totalPaginas);

            Redis::hmset($valores->id_leitor, $totalizadores);
        }

        return response()->json(['message' => 'Totalizadores armazenados com sucesso']);
    }

    public function recuperarTotalLivroslidosPorLeitor($leitorId)
    {
        return Redis::hgetall($leitorId);
    }
}
