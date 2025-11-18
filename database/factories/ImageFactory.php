<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'img_path' => function () {
                $randomName = Str::uuid();
                $imageUrl = "https://picsum.photos/1024/768.webp?random={$randomName}";
                $path = "notes/{$randomName}.webp";
                Storage::disk('public')->put($path, file_get_contents($imageUrl));

                return $path;
            },
            'est_principale' => $this->faker->boolean(),
            'ordre_affichage' => $this->faker->numberBetween(1, 10),
            'projet_id' => \App\Models\Projet::factory(),

        ];
    }
}
