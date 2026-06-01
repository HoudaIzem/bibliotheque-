@extends('layouts.app')

@section('title', __('send_book'))

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">

    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg border border-gray-200 shadow-md">

        <h1 class="text-3xl font-bold text-gray-900">{{ __('send_book') }}</h1>

        <p class="mt-4 text-gray-600">
            {{ __('send_book_note') }}
        </p>

        <!-- Book Info -->
        <div class="mt-6 border rounded-lg bg-gray-50 p-4">
            <h2 class="text-xl font-semibold text-gray-800">{{ $book->designation }}</h2>
            <p class="mt-2 text-gray-600">{{ $book->auteur }}</p>
            <p class="mt-2 text-gray-600">{{ __('price') }}: {{ $book->prix }} DH</p>
        </div>

        <!-- EMAIL FORM -->
        <form method="POST" action="{{ route('book.send.mail', $book->id) }}" class="mt-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required
                       class="mt-1 w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                Send Book
            </button>
        </form>

        <!-- Buttons -->
        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('book.show', $book->id) }}"
               class="inline-flex items-center justify-center px-5 py-3 rounded-md bg-gray-200 text-gray-800 hover:bg-gray-300">
                {{ __('back') }}
            </a>

            <a href="{{ route('contact') }}"
               class="inline-flex items-center justify-center px-5 py-3 rounded-md bg-blue-600 text-white hover:bg-blue-700">
                {{ __('contact_us') }}
            </a>
        </div>

    </div>
</div>
@endsection
