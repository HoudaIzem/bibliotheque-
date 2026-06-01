<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TypeSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\BookSeeder;
use Database\Seeders\PageSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // plant categories, types and tags before books
        $this->call([
            CategorySeeder::class,
            TypeSeeder::class,
            TagSeeder::class,
        ]);

        // add static pages (about/contact etc.)
        $this->call(PageSeeder::class);

        // create a handful of books after the supporting tables exist
        $this->call(BookSeeder::class);
    }
}
