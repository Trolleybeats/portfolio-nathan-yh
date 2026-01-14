<?php

namespace Database\Seeders;

use App\Models\Profil;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::query()->where('admin', true)->value('id') ?? User::query()->value('id');

        Profil::factory()->count(1)->create([
            'user_id' => $userId,
        ]);
    }
}
