@extends('layouts.app')

@section('title', __('book_details_title'))

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-16 pb-8">
        <br />
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Content (Book Details) -->
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-md">
                    <div class="md:flex items-start">
                        <div class="flex-shrink-0 mr-6 mb-4 md:mb-0">
                            <img class="w-48 h-auto object-cover rounded-md shadow-lg mx-auto"
                                src="{{ asset('covers/' . $book->cover) }}" alt="Book Cover"
                                onerror="this.src='{{ asset('covers/no_cover.jpg') }}'">
                        </div>

                        <div class="flex-grow">
                            <h3 class="text-3xl font-bold text-gray-900">
                                {{ $book->designation }}
                            </h3>

                            <ul class="mt-2 flex flex-wrap gap-x-4 gap-y-2 text-gray-500">
                                <li>{{ $book->auteur }}</li>
                                @if ($book->type)
                                    <li class="list-disc list-inside">{{ $book->type->name }}</li>
                                @endif
                            </ul>

                            <div class="mt-6 border-t border-gray-200 pt-6">
                                <h4 class="text-xl font-semibold text-gray-800">
                                    {{ __('description') }}
                                </h4>
                                <p class="mt-4 text-gray-600 leading-relaxed">
                                    {{ $book->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content (Book Overview) -->
            <aside class="col-span-1">
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-md">
                    <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-4">
                        {{ __('book_information') }}
                    </h4>

                    <!-- Book Details List -->
                    <ul class="mt-4 space-y-3 text-gray-600">
                        <li class="flex justify-between items-center">
                            <span class="font-medium">{{ __('year') }}</span>
                            <span class="text-gray-900">{{ $book->annee }}</span>
                        </li>

                        <li class="flex justify-between items-center">
                            <span class="font-medium">{{ __('author') }}</span>
                            <span class="text-gray-900">{{ $book->auteur }}</span>
                        </li>

                        <li class="flex justify-between items-center">
                            <span class="font-medium">{{ __('publisher') }}</span>
                            <span class="text-gray-900">{{ $book->editeur }}</span>
                        </li>

                        <li class="flex justify-between items-center">
                            <span class="font-medium">{{ __('category') }}</span>
                            <span class="text-gray-900">{{ optional($book->category)->name }}</span>
                        </li>

                        <li class="flex justify-between items-center">
                            <span class="font-medium">{{ __('price') }}</span>
                            <span class="text-gray-900 font-semibold">{{ $book->prix }} DH</span>
                        </li>

                        @if ($book->tags->count())
                            <li class="flex justify-between items-start">
                                <span class="font-medium">{{ __('keywords') }}</span>
                                <span class="text-gray-900 text-right">{{ $book->tags->pluck('name')->join(', ') }}</span>
                            </li>
                        @endif
                    </ul>

                    <!-- Action Buttons -->
                    <div class="mt-6 space-y-3">
                        <!-- Buy Button -->
                        <form method="POST" action="{{ route('book.buy', $book->id) }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-150">
                                {{ __('buy') }}
                            </button>
                        </form>

                        <!-- Send Book Button (Conditional) -->
                        @if (auth()->check())
                            <button type="button" onclick="document.getElementById('sendModal').classList.remove('hidden')"
                                class="w-full flex items-center justify-center px-6 py-3 border border-blue-600 text-blue-600 bg-white hover:bg-blue-50 rounded-md">
                                {{ __('send_book') }}
                            </button>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full flex items-center justify-center px-6 py-3 border border-blue-600 text-blue-600 bg-white hover:bg-blue-50 rounded-md">
                                {{ __('send_book') }}
                            </a>
                        @endif
                    </div>
                </div>
            </aside>

        </div>
    </div>
    <div id="sendModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">

            <h2 class="text-xl font-bold mb-4">Send Book via Email</h2>

            <form method="POST" action="{{ route('book.send.mail', $book->id) }}">
                @csrf

                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" required class="w-full border rounded p-2 mb-4"
                    placeholder="Enter email">

                <div class="flex justify-between">

                    <button type="button" onclick="document.getElementById('sendModal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-300 rounded">
                        Cancel
                    </button>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Send
                    </button>

                </div>
            </form>

        </div>
    </div>
@endsection
