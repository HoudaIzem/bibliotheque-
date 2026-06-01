<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        DB::table('book_tag')->delete();
        \App\Models\Book::query()->delete();

        $sampleCovers = collect(\Illuminate\Support\Facades\File::files(public_path('covers')))
            ->map(fn($f) => $f->getFilename())
            ->filter(fn($filename) => $filename !== 'no_cover.jpg')
            ->values()
            ->toArray();

        $categories = \App\Models\Category::pluck('id')->toArray();
        $types = \App\Models\Type::pluck('id')->toArray();
        $tags = \App\Models\Tag::pluck('id')->toArray();

        $titles = [
            'Le Petit Prince', 'L’Étranger', 'Les Misérables', 'Le Comte de Monte-Cristo', 
            'Madame Bovary', 'Le Rouge et le Noir', 'Candide', 'La Peste', 'Germinal', 
            'Notre-Dame de Paris', 'Dune', 'Clean Code', '1984', 'Le Seigneur des Anneaux',
            'Harry Potter à l\'école des sorciers', 'Fondation', 'L\'Alchimiste', 
            'Da Vinci Code', 'Gatsby le Magnifique', 'Orgueil et Préjugés'
        ];

        foreach ($titles as $title) {
            $book = \App\Models\Book::create([
                'designation' => $title,
                'description' => "Un chef-d'œuvre classique de la littérature : " . $title . ". " . $faker->paragraph(),
                'auteur' => $faker->name(),
                'prix' => rand(50, 300),
                'category_id' => !empty($categories) ? $categories[array_rand($categories)] : null,
                'type_id' => !empty($types) ? $types[array_rand($types)] : null,
                'cover' => !empty($sampleCovers) ? $sampleCovers[array_rand($sampleCovers)] : 'no_cover.jpg',
            ]);

            if (!empty($tags)) {
                $randomTags = (array) array_rand(array_flip($tags), rand(1, min(3, count($tags))));
                $book->tags()->sync($randomTags);
            }
        }
    }
}
