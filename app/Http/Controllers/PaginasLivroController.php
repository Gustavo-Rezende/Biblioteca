<?php

namespace App\Http\Controllers;

use App\Models\Leitores;
use App\Models\LivrosLidos;
use Illuminate\Support\Facades\Redis;

class PaginasLivroController extends Controller
{

    public function armazenarTotalLivrosLidosPorLeitor($ano)
    {

        $resultado = LivrosLidos::obterTotaisLivrosLidosPorAno($ano);

        foreach($resultado as $key => $valores) {

            $totalizadores = array('totalLidos'=>$valores->totalLidos,
                                    'totalPaginas'=>$valores->totalPaginas);

            Redis::hmset($valores->id_leitor, $totalizadores);
        }

        return response()->json(['message' => 'Totalizadores armazenados com sucesso']);
    }

    public function retornaTotalLivrosLidosPorLeitor()
    {
        $leitores = Leitores::buscarLeitoresPorDataAniversario();

        $dadosQtdlivros = array();
        $dados = array();
        foreach ($leitores as $leitor) {

            $id = $leitor->id;
            $nomeLeitor = $leitor->nome;
            $dadosQtdlivros =  Redis::hgetall($id);
            $dados[] = [
                'Id' => $id,
                'Nome' => $nomeLeitor,
                'dados' => $dadosQtdlivros,
            ];
        }

        return $dados;
    }
}
