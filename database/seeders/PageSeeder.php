<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'about',
                'title' => 'About Us',
                'body' => "<p>Welcome to our library. We are dedicated to providing excellent service.</p>",
                'image' => 'about-default.jpg',
            ],
            [
                'slug' => 'contact',
                'title' => 'Contact Us',
                'body' => "<p>Feel free to reach out anytime.</p>",
                'image' => 'contact-default.jpg',
            ],
        ];

        foreach ($pages as $data) {
            Page::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
