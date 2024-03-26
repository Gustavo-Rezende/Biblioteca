<?php

namespace Tests\Unit;

use App\Models\Livros;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class livrosTest extends TestCase
{
    use RefreshDatabase;

    public function testCriarLivro()
    {
        $livroData = [
            'id_editora' => 3,
            'nome' => 'Livro de Teste',
            'genero' => 'Ficção',
            'autor' => 'Autor de Teste',
            'ano' => 1880,
            'paginas' => 200,
            'idioma' => 'Português',
            'edicao' => '4',
            'isbn' => '1234567890123',
        ];

        // Chamar a rota da API para criar um novo livro
        $response = $this->post('/api/livros', $livroData);

        // Verificar se o livro foi criado corretamente
        $response->assertStatus(201);

        // Verificar se o livro está no banco de dados
        $this->assertDatabaseHas('livros', $livroData);
    }

    public function testAtualizarLivro()
    {
        $livro = Livros::factory()->create();

        $novosDados = [
            'id_editora' => 1,
            'nome' => 'Novo Nome do Livro',
            'genero' => 'Novo Gênero',
            'autor' => 'Autor de Teste',
            'ano' => '1889',
            'paginas' => 189,
            'idioma' => 'Inglês',
            'edicao' => '2',
            'isbn' => '1234567890321',
        ];

        // Chamar a rota da API para atualizar o livro
        $response = $this->putJson("/api/livros/{$livro->id}", $novosDados);

        // Verificar se o livro foi atualizado corretamente
        $response->assertStatus(200);

        // Verificar se os dados do livro foram atualizados no banco de dados
        $this->assertDatabaseHas('livros', $novosDados);
    }

    public function testExcluirLivro()
    {
        $livro = Livros::factory()->create();

        // Chamar a rota da API para excluir o livro
        $response = $this->deleteJson("/api/livros/{$livro->id}");

        // Verificar se o livro foi excluído corretamente
        $response->assertStatus(200);

        // Verificar se o livro não está mais no banco de dados
        $this->assertDatabaseMissing('livros', ['id' => $livro->id]);
    }
}
