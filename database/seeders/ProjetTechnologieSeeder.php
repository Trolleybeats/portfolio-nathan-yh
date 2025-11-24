<?php

namespace Database\Seeders;

use App\Models\Projet;
use App\Models\Technologie;
use Illuminate\Database\Seeder;

class ProjetTechnologieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projets = Projet::all();
        $technologies = Technologie::all();

        if ($projets->isEmpty() || $technologies->isEmpty()) {
            $this->command->info('Aucun projet ou technologie trouvé. Seeder ignoré.');
            return;
        }

        // Associer des technologies aléatoires à chaque projet
        foreach ($projets as $projet) {
            // Associer entre 2 et 5 technologies aléatoires à chaque projet
            $randomTechnologies = $technologies->random(rand(2, min(5, $technologies->count())));
            $projet->technologies()->attach($randomTechnologies->pluck('id')->toArray());
        }

        $this->command->info('Technologies associées aux projets avec succès !');
    }
}
