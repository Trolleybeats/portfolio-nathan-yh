<?php

namespace Database\Seeders;

use App\Models\Technologie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Technologie::factory()->count(10)->create();
    }
}
