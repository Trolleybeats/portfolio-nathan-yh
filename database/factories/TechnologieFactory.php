<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Technologie>
 */
class TechnologieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->word(),
            'categorie' => $this->faker->randomElement(['Frontend', 'Backend', 'Database', 'DevOps']),
            'niveau' => $this->faker->randomElement(['Débutant', 'Intermédiaire', 'Avancé']),
            'ordre_affichage' => $this->faker->numberBetween(1, 100),
        ];
    }
}
