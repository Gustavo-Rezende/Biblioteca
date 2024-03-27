<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Leitores;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\DB;

class leitoresTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();

        $this->user = User::factory()->create();

        Sanctum::actingAs($this->user);
    }

    public function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }

    /** @test */
    public function teste_criar_leitor()
    {

        $data = [
            'nome' => 'Maria Souza',
            'email' => 'maria23@example.com',
            'telefone' => '(99) 8765-4321',
            'endereco' => 'Rua jardim, 899',
            'data_aniversario' => '1988-10-15',
        ];

        $response = $this->postJson('/api/leitores', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('leitores', $data);
    }

    /** @test */
    public function teste_atualizar_leitor()
    {

        $data = [
            'nome' => 'Maria Souza',
            'email' => 'maria123@example.com',
            'telefone' => '(99) 8765-4321',
            'endereco' => 'Rua jardim, 899',
            'data_aniversario' => '1988-10-15',
        ];

        $leitor = Leitores::factory()->create($data);

        $novoEmail = 'joana123@example.com';

        $data['email'] = $novoEmail;

        $response = $this->put('/api/leitores/' . $leitor->id, $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('leitores', ['id' => $leitor->id, 'email' => $novoEmail]);
    }

    /** @test */
    public function teste_recuperar_leitor()
    {
        $leitor = Leitores::factory()->create();

        $response = $this->get('api/leitores/' . $leitor->id);

        $response->assertStatus(200);
    }

    /** @test */
    public function teste_deletar_leitor()
    {
        $leitor = Leitores::factory()->create();

        $leitor->forceDelete();

        $this->assertDatabaseMissing('leitores', ['id' => $leitor->id]);
    }
}
