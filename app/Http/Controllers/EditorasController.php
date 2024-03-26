<?php

namespace App\Http\Controllers;

use App\Models\Editoras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        try {
            $this->validacao($request);
            Editoras::create($request->all());
            return response()->json(['message' => 'Editora salva com sucesso'], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Editora não encontrada'], 404);
        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'Rota não encontrada'], 404);
        } catch (\Exception $e) {
            // Log de erro
            Log::error($e);

            return response()->json(['error' => 'Ocorreu um erro inesperado'], 500);
        }
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
        try {
            $this->validacao($request);
            $editora = Editoras::findOrFail($id);
            $editora->update($request->all());
            return $editora;
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Editora não encontrada'], 404);
        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'Rota não encontrada'], 404);
        } catch (\Exception $e) {
            // Log de erro
            Log::error($e);

            return response()->json(['error' => 'Ocorreu um erro inesperado'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $editora = Editoras::findOrFail($id);
        $editora->delete();
        return response()->json(['success' => 'Registro excluído com sucesso'], 204);
    }

    /**
     * Valida campos para cadastro e update.
     */
    private function validacao($request)
    {
        return $request->validate([
            'nome' => 'required|string|max:50',
            'telefone' => 'string|max:20',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O campo nome não pode exceder 50 caracteres.',
            'telefone.max' => 'O campo telefone não pode exceder 20 caracteres.',
        ]);
    }
}
