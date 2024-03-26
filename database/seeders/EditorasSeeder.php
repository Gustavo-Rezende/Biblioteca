<?php

namespace Database\Seeders;

use App\Models\Editoras;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EditorasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Editoras::factory()->count(5)->create();
    }
}
