@extends('layouts.app')

@section('title', 'Créer un livre')
@section('content')

<div class="py-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-xl">
        <!-- Message d'erreur -->
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

        <h2 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">
            {{ __('create_book') }}
        </h2>

        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white p-8 rounded-xl shadow space-y-6">
            @csrf

            <!-- Designation -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('book_title') }}
                </label>
                <input type="text" name="designation" value="{{ old('designation') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Auteur -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('author') }}
                </label>
                <input type="text" name="auteur" value="{{ old('auteur') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('description') }}
                </label>
                <textarea name="description" rows="4"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <!-- Prix -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('price_mad') }}
                </label>
                <input type="number" name="prix" step="0.01" value="{{ old('prix') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Cover -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('book_cover') }}
                </label>
                <input type="file" name="cover"
                       class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('category') }}
                </label>
                <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">{{ __('choose') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('book_type') }}
                </label>
                <select name="type_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">{{ __('choose') }}</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tags -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('keywords') }}
                </label>
                <select name="tags[]" multiple class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ (collect(old('tags'))->contains($tag->id)) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('book.index') }}"
                   class="text-gray-600 hover:underline">
                    {{ __('back') }}
                </a>

                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    {{ __('save') }}
                </button>
            </div>


        </form>
    </div>
</div>
@endsection
