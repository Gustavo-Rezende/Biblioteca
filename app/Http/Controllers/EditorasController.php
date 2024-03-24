<?php

namespace App\Http\Controllers;

use App\Models\Editoras;
use Illuminate\Http\Request;

class EditorasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Editoras::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'string|max:20',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
        ]);

        $editora = Editoras::create($request->all());

        return response()->json($editora, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $editora =  Editoras::find($id);

        if (!$editora) {
            return response()->json(['message' => 'Editora não encontrada'], 404);
        }

        return $editora;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $editora = Editoras::findOrFail($id);
        $editora->update($request->all());
        return $editora;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $editora = Editoras::findOrFail($id);
        $editora->delete();
        return response()->json([], 204);
    }
}
