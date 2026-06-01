@extends('layouts.app')
@section('title', __('books'))
@section('content')

    <div class="py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                @can('create', App\Models\Book::class)
                <a href="{{ route('book.create') }}"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    {{ __('create_book') }}
                </a>
                @endcan

                <h2 class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">{{ __('browse_books') }}</h2>

            </div>
            <div class="flex justify-center md:justify-end mb-8 container mx-auto px-4">
                <form action="{{ route('book.index') }}" method="GET" id="sortForm"
                    class="flex items-center gap-3 bg-gray-50 p-2 rounded-lg border border-gray-200 shadow-sm">
                    <label for="sort" class="text-sm font-bold text-gray-700 ml-2">{{ __('sort_by_label') }}</label>
                    <select name="sort" id="sort" onchange="this.form.submit()"
                        class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5 pl-3 pr-10">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>{{ __('most_recent') }}
                        </option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('oldest') }}</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>{{ __('price_low') }}
                        </option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>{{ __('price_high') }}
                        </option>
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>{{ __('name_az') }}</option>
                    </select>
                </form>
            </div>
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($books as $book)
                    <div
                        class="group relative bg-white rounded-xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-200 overflow-hidden">
                        <!-- Book Cover -->
                        <div class="aspect-[3/4] overflow-hidden bg-gray-100">
                            <img src="{{ asset('covers/' . $book->cover) }}" alt="{{ $book->designation }}"
                                class="w-full h-full object-cover" onerror="this.src='{{ asset('covers/2.jpg') }}'">
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            onerror="this.src='{{ asset('covers/1.png') }}'">
                        </div>

                        <!-- Card Content -->
                        <div class="p-5 space-y-4">
                            <h3 class="font-bold text-lg text-gray-900 line-clamp-2 leading-tight">
                                {{ $book->designation }}
                            </h3>
                            <p class="text-sm text-gray-600">{{ $book->auteur }}</p>
                            <p class="text-xs text-gray-400">{{ optional($book->category)->name }} @if($book->type) - {{ optional($book->type)->name }}@endif</p>

                            <!-- Action Buttons -->
                            <div class="flex justify-center gap-6 pt-3 border-t border-gray-100">
                                <!-- View -->
                                <a href="{{ route('book.show', $book->id) }}"
                                    class="group/btn flex flex-col items-center gap-1 text-gray-600 hover:text-blue-600 transition"
                                    title="{{ __('view') }}">
                                    <div class="p-3 rounded-full bg-blue-50 group-hover/btn:bg-blue-100 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium">{{ __('view') }}</span>
                                </a>

                                @can('update', $book)
                                    <!-- Edit -->
                                    <a href="{{ route('book.edit', $book->id) }}"
                                        class="group/btn flex flex-col items-center gap-1 text-gray-600 hover:text-amber-600 transition"
                                        title="{{ __('edit') }}">
                                        <div class="p-3 rounded-full bg-amber-50 group-hover/btn:bg-amber-100 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium">{{ __('edit') }}</span>
                                    </a>
                                @endcan

                                @can('delete', $book)
                                    <!-- Delete -->
                                    <form action="{{ route('book.destroy', $book->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('{{ __('confirm_delete') }}')"
                                            class="group/btn flex flex-col items-center gap-1 text-gray-600 hover:text-red-600 transition"
                                            title="{{ __('delete') }}">
                                            <div class="p-3 rounded-full bg-red-50 group-hover/btn:bg-red-100 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </div>
                                            <span class="text-xs font-medium">{{ __('delete') }}</span>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- pagination controls -->
            <div class="mt-8 flex justify-center">
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection
