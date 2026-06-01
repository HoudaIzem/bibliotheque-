@extends('layouts.app')
@section('title', __('search'))
@section('content')

<main class="py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-900">{{ __('search_book') }}</h2>
            <p class="mt-4 text-lg text-gray-600">{{ __('find_all_books') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <form method="GET" action="{{ route('books') }}" class="col-span-1 lg:col-span-4 grid grid-cols-1 lg:grid-cols-4 gap-8">

                <aside class="col-span-1">
                    <div class="bg-white p-6 rounded-lg border shadow-md space-y-6">

                        <h4 class="text-xl font-semibold border-b pb-3">
                            {{ __('filter_books') }}
                        </h4>

                        <!-- Category -->
                        <div>
                            <label class="block font-semibold mb-2">{{ __('category') }}</label>
                            <select name="category"
                                    onchange="this.form.submit()"
                                    class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">

                                <option value="">{{ __('all') }}</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Type -->
                        <div>
                            <label class="block font-semibold mb-2">{{ __('type') }}</label>
                            <select name="type"
                                    onchange="this.form.submit()"
                                    class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">

                                <option value="">{{ __('all') }}</option>

                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ request('type') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </aside>

                <!-- Books Section -->
                <div class="col-span-1 lg:col-span-3">

                    <!-- Sorting + Count -->
                    <div class="flex justify-between items-center mb-6 bg-white p-4 rounded shadow">

                        <span class="text-gray-600">
                            {{ $books->total() }} {{ __('books_found') }}
                        </span>

                        <!-- SORT -->
                        <div class="flex items-center gap-2">

                            <label class="text-sm font-medium">{{ __('sort_by_label') }}</label>

                            <select name="sort"
                                    onchange="this.form.submit()"
                                    class="border rounded p-2 text-sm focus:ring-2 focus:ring-blue-500">

                                <option value="">{{ __('sort_by') }}</option>

                                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>
                                    {{ __('title') }}
                                </option>

                                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>
                                    {{ __('price') }}
                                </option>

                                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>
                                    {{ __('date') }}
                                </option>

                                <option value="type" {{ request('sort') == 'type' ? 'selected' : '' }}>
                                    {{ __('type') }}
                                </option>

                            </select>

                        </div>

                    </div>

                    <!-- Books List -->
                    <div class="space-y-6">

                        @forelse($books as $book)

                        <a href="{{ route('book.show', $book->id) }}"
                           class="block bg-white rounded-lg p-4 flex justify-between border shadow hover:shadow-lg transition-all duration-150">

                            <div class="flex items-center">

                                <img src="{{ asset('covers/' . ($book->cover ?? '1.png')) }}"
                                     class="w-20 mr-4 rounded">

                                <div>
                                    <h3 class="text-lg font-semibold">
                                        {{ $book->designation }}
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        {{ __('by') }} {{ $book->auteur }}
                                    </p>

                                    <p class="text-sm text-gray-400">
                                        {{ optional($book->category)->name }}
                                        @if($book->type) – {{ optional($book->type)->name }} @endif
                                    </p>
                                </div>

                            </div>

                            <div class="text-right flex flex-col items-end gap-2">
                                <span class="text-lg font-bold text-gray-800">
                                    ${{ $book->prix }}
                                </span>
                            </div>

                        </a>

                        @empty

                        <div class="text-center py-12 bg-white rounded-lg border shadow">
                            <h3 class="mt-2 text-sm font-medium text-gray-900">{{ __('no_books') }}</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Try adjusting your search filters or browse all categories.
                            </p>

                            <div class="mt-6">
                                <a href="{{ route('books') }}" class="text-blue-600 hover:text-blue-500">
                                    Clear filters →
                                </a>
                            </div>
                        </div>

                        @endforelse

                    </div>

                    <!-- Pagination -->
                    <div class="mt-10">
                        {{ $books->links() }}
                    </div>

                </div>

            </form>

        </div>
    </div>
</main>

@endsection
