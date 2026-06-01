<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = ['romance','aventure','histoire','science','jeunesse','drame'];
        foreach ($tags as $name) {
            Tag::firstOrCreate(
                ['name' => ucfirst($name)],
                ['slug' => Str::slug($name)]
            );
        }
    }
}
