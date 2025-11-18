<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'diplome' => $this->faker->sentence(3),
            'etablissement' => $this->faker->company(),
            'lieu' => $this->faker->city(),
            'date_obtention' => $this->faker->date(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
