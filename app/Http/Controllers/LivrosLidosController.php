<?php

namespace App\Http\Controllers;

use App\Models\LivrosLidos;
use Illuminate\Http\Request;

class LivrosLidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LivrosLidos::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_livro' => 'required|integer',
            'id_leitor' => 'required|integer',
        ], [
            'id_livro.required' => 'O campo livro é obrigatório.',
            'id_livro.integer' => 'O campo livro deve ser um número inteiro.',
            'id_leitor.required' => 'O campo leitor é obrigatório.',
            'id_leitor.integer' => 'O campo leitor deve ser um número inteiro.',
        ]);

        $livroslidos = LivrosLidos::create($request->all());
        return response()->json($livroslidos, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ano)
    {
        // $ano = '2024';
        return LivrosLidos::obterTotaisLivrosLidosPorAno($ano);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $livrosLidos = LivrosLidos::findOrFail($id);
        $livrosLidos->update($request->all());
        return $livrosLidos;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $livrosLidos = LivrosLidos::findOrFail($id);
        $livrosLidos->delete();
        return response()->json([], 204);
    }
}
