<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projet>
 */
class ProjetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence(3),
            'slug' => $this->faker->unique()->slug(),
            'description_courte' => $this->faker->paragraph(),
            'description_longue' => $this->faker->paragraphs(3, true),
            'type' => $this->faker->randomElement(['Web', 'Mobile', 'API', 'Design']),
            'statut' => $this->faker->randomElement(['Brouillon', 'Publié', 'Archivé']),
            'date' => $this->faker->date(),
            'client' => $this->faker->company(),
            'contexte' => $this->faker->sentence(),
            'duree' => $this->faker->randomElement(['1 mois', '3 mois', '6 mois', '1 an', null]),
            'role' => $this->faker->randomElement(['Développeur', 'Designer', 'Chef de projet', null]),
            'projet_url' => $this->faker->url(),
            'github_url' => $this->faker->optional()->url(),
            'ordre_affichage' => $this->faker->numberBetween(1, 10),
        ];
    }
}
