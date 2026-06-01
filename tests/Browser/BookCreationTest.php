<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase; // This will be available once dusk is installed

class BookCreationTest extends DuskTestCase
{
    /**
     * Test de création d'un livre via l'interface (Dusk)
     */
    public function test_admin_can_create_a_book(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        
        if (!$admin) {
            $admin = User::factory()->create([
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => bcrypt('password')
            ]);
        }

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/book/create')
                    ->type('designation', 'Le Nouveau Livre Test')
                    ->type('auteur', 'Auteur Dusk')
                    ->type('prix', '150')
                    ->type('description', 'Test description pour Laravel Dusk.')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/book')
                    ->assertSee('Le Nouveau Livre Test');
        });
    }
}
