<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'poste' => $this->faker->jobTitle(),
            'entreprise' => $this->faker->company(),
            'lieu' => $this->faker->city(),
            'date_debut' => $this->faker->date(),
            'date_fin' => $this->faker->date(),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['Stage', 'CDI', 'CDD', 'Freelance', 'Bénévolat']),
        ];
    }
}
