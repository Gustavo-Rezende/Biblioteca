<?php

namespace App\Http\Controllers;

use App\Models\Livros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class LivrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Livros::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_editora' => 'required|integer',
            'nome' => 'required|string|max:255',
            'genero' => 'required|string|max:50',
            'autor' => 'required|string|max:255',
            'ano' => 'required|integer|digits:4',
            'paginas' => 'required|integer',
            'idioma' => 'required|string|max:20',
            'edicao' => 'required|string|max:2',
            'isbn' => 'required|integer|max:13',
        ], [
            'id_editora.required' => 'O campo editora é obrigatório.',
            'id_editora.integer' => 'O campo editora deve ser um número inteiro.',
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O campo nome não pode exceder 255 caracteres.',
            'genero.required' => 'O campo gênero é obrigatório.',
            'genero.max' => 'O campo gênero não pode exceder 50 caracteres.',
            'autor.required' => 'O campo autor é obrigatório.',
            'autor.max' => 'O campo autor não pode exceder 255 caracteres.',
            'ano.required' => 'O campo ano é obrigatório.',
            'ano.integer' => 'O campo ano deve ser um número inteiro.',
            'ano.digits' => 'O campo ano deve ter 4 dígitos.',
            'paginas.required' => 'O campo páginas é obrigatório.',
            'paginas.integer' => 'O campo páginas deve ser um número inteiro.',
            'idioma.required' => 'O campo idioma é obrigatório.',
            'idioma.max' => 'O campo idioma não pode exceder 20 caracteres.',
            'edicao.required' => 'O campo edição é obrigatório.',
            'edicao.max' => 'O campo edição não pode exceder 2 caracteres.',
            'isbn.required' => 'O campo ISBN é obrigatório.',
            'isbn.integer' => 'O campo ISBN deve ser um número inteiro.',
            'isbn.max' => 'O campo ISBN não pode exceder 13 caracteres.',
        ]);

        $livro = Livros::create($request->all());

        return response()->json($livro, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $livro =  Livros::find($id);

        if (!$livro) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        return $livro;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $livro = Livros::find($id);
        $request->validate([
            'nome' => 'required|string|max:255',
            'genero' => 'required|string|max:50',
            'autor' => 'required|string|max:255',
            'ano' => 'required|integer',
            'paginas' => 'required|integer',
            'idioma' => 'required|string|max:10',
            'edicao' => 'required|string|max:2',
            'isbn' => 'required|integer',
        ]);

        $livro->update($request->all());

        return response()->json($livro, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $livro = Livros::findOrFail($id);
        $livro->delete();
        return response()->json([], 204);
    }
}
