<?php

namespace Tests\Unit;

use App\Models\Editoras;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class editorasTest extends TestCase
{
    use RefreshDatabase;

    public function testCriarEditora()
    {
        $editoraData = [
            'nome' => 'Editora de Teste',
            'telefone' => '1234-5678',
        ];

        // Chamar a rota da API para criar uma nova editora
        $response = $this->postJson('/api/editoras', $editoraData);

        // Verificar se a editora foi criada corretamente
        $response->assertStatus(201);

        // Verificar se a editora está no banco de dados
        $this->assertDatabaseHas('editoras', $editoraData);
    }

    public function testAtualizarEditora()
    {
        $editora = Editoras::factory()->create();

        $novosDados = [
            'nome' => 'Novo Nome da Editora',
            'telefone' => '8765-4321',
            // Adicione outros campos que deseja atualizar...
        ];

        // Chamar a rota da API para atualizar a editora
        $response = $this->putJson("/api/editoras/{$editora->id}", $novosDados);

        // Verificar se a editora foi atualizada corretamente
        $response->assertStatus(200);

        // Verificar se os dados da editora foram atualizados no banco de dados
        $this->assertDatabaseHas('editoras', $novosDados);
    }

    public function testExcluirEditora()
    {
        $editora = Editoras::factory()->create();

        // Chamar a rota da API para excluir a editora
        $response = $this->deleteJson("/api/editoras/{$editora->id}");

        // Verificar se a editora foi excluída corretamente
        $response->assertStatus(200);

        // Verificar se a editora não está mais no banco de dados
        $this->assertDatabaseMissing('editoras', ['id' => $editora->id]);
    }
}
