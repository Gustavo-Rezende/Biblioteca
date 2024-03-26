<?php

namespace Database\Seeders;

use App\Models\Leitores;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeitoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Leitores::factory()->count(5)->create();
    }
}
