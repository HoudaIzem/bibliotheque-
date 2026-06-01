<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // gather available cover files from public directory
        $covers = [];
        try {
            $covers = collect(\Illuminate\Support\Facades\File::files(public_path('covers')))
                        ->map(fn($f) => $f->getFilename())
                        ->filter()
                        ->toArray();
        } catch (\Exception $e) {
            // fallback if directory missing
        }

        return [
            'designation' => $this->faker->unique()->sentence(3),
            'description' => $this->faker->paragraph(),
            'langue' => $this->faker->randomElement([
                'Arabe',
                'Francais',
                'Anglais',
                'Espagnol',
                'Allemand'
            ]),
            'editeur' => $this->faker->company(),
            'prix' => $this->faker->randomFloat(2, 0, 900),
            'auteur' => $this->faker->name(),
            'cover' => $covers ? $this->faker->randomElement($covers) : 'no_cover.jpg',
            // assign to an existing category/type if available, else null
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id,
            'type_id' => \App\Models\Type::inRandomOrder()->first()?->id,
        ];
    }
}
