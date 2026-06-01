<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        // ensure required types
        $types = ['Audio','Ebook','Pdf','Texte','Image'];
        foreach ($types as $name) {
            Type::firstOrCreate(['name' => $name]);
        }
    }
}
