<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_normal_user_cannot_create_book()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('book.create'));
        $response->assertStatus(403);
    }

    public function test_admin_can_create_book()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('book.create'));
        $response->assertStatus(200);
    }

    public function test_normal_user_cannot_delete_book()
    {
        $user = User::factory()->create(['role' => 'user']);
        $book = Book::factory()->create();

        $response = $this->actingAs($user)->delete(route('book.destroy', $book->id));
        $response->assertStatus(403);
    }

    public function test_admin_can_delete_book()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $book = Book::factory()->create();

        $response = $this->actingAs($admin)->delete(route('book.destroy', $book->id));
        $response->assertStatus(302); // Redirects back after delete
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
