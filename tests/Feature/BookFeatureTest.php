<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendBookMail;
use Tests\TestCase;

class BookFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_book_details()
    {
        $book = Book::factory()->create();

        $response = $this->get(route('book.show', $book->id));

        $response->assertStatus(200);
        $response->assertSee($book->designation);
    }

    public function test_can_buy_book()
    {
        $book = Book::factory()->create();

        $response = $this->post(route('book.buy', $book->id));

        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    public function test_can_send_book_email()
    {
        Mail::fake();

        $book = Book::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('book.send.mail', $book->id), [
            'email' => 'test@example.com'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');

        Mail::assertSent(SendBookMail::class, function ($mail) use ($book) {
            return $mail->hasTo('test@example.com') &&
                   $mail->book->id === $book->id;
        });
    }
}
