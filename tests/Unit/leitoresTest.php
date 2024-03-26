<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
// use Illuminate\Foundation\Auth\User;
use App\Models\Leitores;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class leitoresTest extends TestCase
{

    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function authenticated_user_can_create_a_leitor()
    {
        $this->actingAs($this->user);

        $data = [
            'nome' => 'Maria Souza',
            'email' => 'maria@example.com',
            'telefone' => '(99) 8765-4321',
            'endereco' => 'Rua jardim, 899',
            'data_aniversario' => '1988-10-15',
        ];

        $response = $this->post('/leitores', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('leitores', $data);
    }

    /** @test */
    public function authenticated_user_can_update_a_leitor()
    {
        $this->actingAs($this->user);

        $leitor = Leitores::factory()->create(['nome' => 'Joana Brito']);

        $data = ['nome' => 'Joana Teixeira'];

        $response = $this->put('/leitores/' . $leitor->id, $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('leitores', ['id' => $leitor->id, 'name' => 'Jane Smith']);
    }

    /** @test */
    public function authenticated_user_can_delete_a_leitor()
    {
        $this->actingAs($this->user);

        $leitor = Leitores::factory()->create();

        $response = $this->delete('/leitores/' . $leitor->id);

        $response->assertStatus(200);

        $this->assertSoftDeleted('leitores', ['id' => $leitor->id]);
    }

    /** @test */
    public function authenticated_user_can_retrieve_a_leitor()
    {
        $this->actingAs($this->user);

        $leitor = Leitores::factory()->create();

        $response = $this->get('/leitores/' . $leitor->id);

        $response->assertStatus(200);
    }
}
