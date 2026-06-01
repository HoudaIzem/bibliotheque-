@extends('layouts.app')
@section('title', __('home'))
@section('content')

<!-- Hero Area Start-->

        <div class="relative bg-gray-100 py-32 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
            <div class="relative max-w-4xl mx-auto text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">{{ __('find_all_books') }}</h1>
                <p class="mt-6 text-xl text-gray-600">{{ __('browse_collection') }}</p>

                <!-- Search Box -->
                <div class="mt-12 max-w-3xl mx-auto">
                    <form action="{{ route('books') }}" method="GET" class="sm:flex items-center bg-white rounded-lg p-2 border border-gray-300 shadow-lg">
                        <div class="min-w-0 flex-1">
                            <input type="text" name="search" placeholder="{{ __('placeholder_search') }}" class="w-full bg-transparent border-0 text-gray-800 placeholder-gray-500 focus:ring-0 sm:text-sm px-4 py-3">
                        </div>
                        <div class="mt-2 sm:mt-0 sm:ml-2">
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">{{ __('find_button') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->

        <!-- Categories Start -->
        <div class="py-24 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <span class="text-blue-600 font-semibold">{{ __('best_categories') }}</span>
                    <h2 class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">{{ __('browse_categories') }}</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @forelse($categories as $category)
                    <a href="{{ route('books', ['category' => $category->id]) }}" class="group bg-white p-8 rounded-lg text-center border border-gray-200 shadow-md hover:shadow-2xl transition-all duration-300 hover:border-blue-300">
                        <div class="mb-4 inline-flex items-center justify-center p-4 bg-blue-50 rounded-full group-hover:bg-blue-100 transition-colors duration-300">
                            @if(strtolower($category->name) === 'science fiction')
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            @elseif(strtolower($category->name) === 'fantastique')
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @elseif(strtolower($category->name) === 'classique')
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.228 6.228 2 10.228 2 15s4.228 8.772 10 8.772 10-4.228 10-8.772c0-4.772-4.228-8.747-10-8.747z"></path></svg>
                            @elseif(strtolower($category->name) === 'horreur')
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 105.656 5.656m-2.828-7.484a4 4 0 01-3.536 8.364"></path></svg>
                            @elseif(strtolower($category->name) === 'romance')
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            @elseif(strtolower($category->name) === 'mystere')
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @elseif(strtolower($category->name) === 'documentaires')
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            @elseif(strtolower($category->name) === 'poésie')
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            @elseif(strtolower($category->name) === 'mangas')
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @else
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.228 6.228 2 10.228 2 15s4.228 8.772 10 8.772 10-4.228 10-8.772c0-4.772-4.228-8.747-10-8.747z"></path></svg>
                            @endif
                        </div>
                        <h5 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">{{ $category->name }}</h5>
                    </a>
                    @empty
                    <p class="text-gray-500 col-span-full text-center py-8">{{ __('no_categories') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Categories End -->
@endsection
