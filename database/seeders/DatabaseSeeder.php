<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->withoutTwoFactor()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'admin' => true,
        ]);
        $this->call([
            ProfilSeeder::class,
            TechnologieSeeder::class,
            ExperienceSeeder::class,
            EducationSeeder::class,
            ProjetSeeder::class,
            ProjetTechnologieSeeder::class,
            ]);
    }
}
