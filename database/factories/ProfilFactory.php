<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profil>
 */
class ProfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'titre' => $this->faker->jobTitle(),
            'bio' => $this->faker->paragraph(),
            'profil_photo' => $this->faker->imageUrl(200, 200, 'people'),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->address(),
            'disponibilite' => $this->faker->randomElement(['Disponible', 'Indisponible', 'En mission']),
            'linkedin' => $this->faker->url(),
            'github' => $this->faker->url(),
            'cv_path' => null,
        ];
    }
}
