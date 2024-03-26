<?php

namespace App\Http\Controllers;

use App\Models\Livros;
use App\Models\Editoras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        try {
            $this->validacao($request);

            if(!Editoras::editoraExiste($request->id_editora)) {
                return response()->json(['error' => 'Editora não encontrada'], 404);
            }

            Livros::create($request->all());

            return response()->json(['message' => 'Livro salvo com sucesso'], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
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
        try {
            $livro = Livros::find($id);
            $this->validacao($request);

            if(!Editoras::editoraExiste($request->id_editora)) {
                return response()->json(['error' => 'Editora não encontrada'], 404);
            }

            $livro->update($request->all());
            return response()->json($livro, 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
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
        $livro = Livros::findOrFail($id);
        $livro->delete();
        return response()->json(['success' => 'Registro excluído com sucesso'], 204);
    }

    /**
     * Valida campos para cadastro e update.
     */
    private function validacao($request)
    {
        return $request->validate([
            'id_editora' => 'required|integer',
            'nome' => 'required|string|max:255',
            'genero' => 'required|string|max:50',
            'autor' => 'required|string|max:255',
            'ano' => 'required|integer|digits:4',
            'paginas' => 'required|integer',
            'idioma' => 'required|string|max:20',
            'edicao' => 'required|string|max:2',
            'isbn' => 'required|integer',
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
        ]);
    }
}
