<?php

namespace Database\Factories;

use App\Models\Leitores;
use App\Models\Livros;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LivrosLidos>
 */
class LivrosLidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_leitor' => Leitores::factory(), // Define a relação com um leitor existente
            'id_livro' => Livros::factory(), // Define a relação com um livro existente
        ];
    }
}
