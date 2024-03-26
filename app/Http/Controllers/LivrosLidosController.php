<?php

namespace App\Http\Controllers;

use App\Models\LivrosLidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        try {
            $this->validacao($request);
            LivrosLidos::create($request->all());
            return response()->json(['message' => 'Registro salvo com sucesso'], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Registro não encontrado'], 404);
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
    public function show(string $ano)
    {
        return LivrosLidos::obterTotaisLivrosLidosPorAno($ano);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->validacao($request);
            $livrosLidos = LivrosLidos::findOrFail($id);
            $livrosLidos->update($request->all());
            return $livrosLidos;
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Registro não encontrado'], 404);
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
        $livrosLidos = LivrosLidos::findOrFail($id);
        $livrosLidos->delete();
        return response()->json(['success' => 'Registro excluído com sucesso'], 204);
    }

    /**
     * Valida campos para cadastro e update.
     */
    private function validacao($request)
    {
        return $request->validate([
            'id_livro' => 'required|integer',
            'id_leitor' => 'required|integer',
        ], [
            'id_livro.required' => 'O campo livro é obrigatório.',
            'id_livro.integer' => 'O campo livro deve ser um número inteiro.',
            'id_leitor.required' => 'O campo leitor é obrigatório.',
            'id_leitor.integer' => 'O campo leitor deve ser um número inteiro.',
        ]);
    }
}
