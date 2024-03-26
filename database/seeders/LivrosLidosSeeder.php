<?php

namespace Database\Seeders;

use App\Models\LivrosLidos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LivrosLidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LivrosLidos::factory()->count(5)->create();
    }
}
