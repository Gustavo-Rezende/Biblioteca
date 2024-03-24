<?php

namespace App\Http\Controllers;

use App\Models\Leitores;
use Illuminate\Http\Request;

class LeitoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Leitores::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd("passou aqui");
        $validateData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:leitores|max:255',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'data_aniversario' => 'required|date',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email fornecido não é válido.',
            'email.unique' => 'Este email já está sendo utilizado.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'endereco.required' => 'O campo endereço é obrigatório.',
            'data_aniversario.required' => 'O campo data de aniversário é obrigatório.',
            'data_aniversario.date' => 'O campo data de aniversário deve ser uma data válida.',
        ]);
dd($validateData);
        return response()->json($validateData, 201);
        // $leitor = Leitores::create($request->all());

        // return response()->json($leitor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leitor =  Leitores::find($id);

        if (!$leitor) {
            return response()->json(['message' => 'Leitor não encontrado'], 404);
        }

        return $leitor;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $leitor = Leitores::findOrFail($id);
        $leitor->update($request->all());
        return $leitor;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leitor = Leitores::findOrFail($id);
        $leitor->delete();
        return response()->json([], 204);
    }
}
