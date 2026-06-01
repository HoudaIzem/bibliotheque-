<h2>Book Details</h2>

@if($book->cover)
    <img src="{{ $message->embed(public_path('covers/' . $book->cover)) }}"
        style="width:200px; border-radius:8px;">
@endif

<p><strong>Title:</strong> {{ $book->designation }}</p>
<p><strong>Author:</strong> {{ $book->auteur }}</p>
<p><strong>Price:</strong> {{ $book->prix }} DH</p>

@if($book->category)
<p><strong>Category:</strong> {{ $book->category->name }}</p>
@endif

@if($book->type)
<p><strong>Type:</strong> {{ $book->type->name }}</p>
@endif

<hr>

<p>Sent from Book App </p>
