<?php

namespace Database\Seeders;

use App\Models\Livros;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LivrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Livros::factory()->count(5)->create();
    }
}
