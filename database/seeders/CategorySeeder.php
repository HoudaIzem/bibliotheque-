<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Science Fiction','Fantastique','Classique','Horreur','Romance','Mystere','Documentaires','Poésie','Mangas'];
        foreach ($names as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}
