<?php

namespace App\Mail;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBookMail extends Mailable
{
    use Queueable, SerializesModels;

    public $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function build()
    {
        return $this->subject('Book Recommendation')
            ->view('emails.book');
    }
}
