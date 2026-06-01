<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_authenticate_and_get_token()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Assumes that the login route returns a token
        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());
        
        $token = $response->json('token');

        // Test accessing protected route
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/user');

        $response->assertStatus(200);
        $response->assertJson([
            'email' => $user->email,
        ]);
    }

    public function test_unauthenticated_user_cannot_access_protected_route()
    {
        $response = $this->getJson('/api/user');
        $response->assertStatus(401);
    }
}
