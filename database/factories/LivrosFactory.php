<?php

namespace Database\Factories;

use App\Models\Editoras;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livros>
 */
class LivrosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_editora' => Editoras::factory(), // Define a relação com uma editora existente
            'nome' => $this->faker->sentence,
            'genero' => $this->faker->word,
            'autor' => $this->faker->name,
            'ano' => $this->faker->optional()->year,
            'paginas' => $this->faker->numberBetween(100, 1000),
            'idioma' => $this->faker->languageCode,
            'edicao' => $this->faker->numberBetween(1, 10),
            'isbn' => $this->faker->isbn10,
        ];
    }
}
