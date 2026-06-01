@extends('layouts.app')

@section('title', 'Modifier le livre')

@section('content')
<div class="py-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-xl">

        <h2 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">
            Modifier le livre
        </h2>

        <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Designation -->
            <div class="mb-4">
                <label class="block font-medium">Désignation</label>
                <input type="text" name="designation"
                       value="{{ old('designation', $book->designation) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- Auteur -->
            <div class="mb-4">
                <label class="block font-medium">Auteur</label>
                <input type="text" name="auteur"
                       value="{{ old('auteur', $book->auteur) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- Prix -->
            <div class="mb-4">
                <label class="block font-medium">Prix</label>
                <input type="number" step="0.01" name="prix"
                       value="{{ old('prix', $book->prix) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label class="block font-medium">Catégorie</label>
                <select name="category_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Choisir --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id)==$category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Type -->
            <div class="mb-4">
                <label class="block font-medium">Type</label>
                <select name="type_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Choisir --</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id', $book->type_id)==$type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tags -->
            <div class="mb-4">
                <label class="block font-medium">Mots-clés</label>
                <select name="tags[]" multiple class="w-full border rounded px-3 py-2">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ (collect(old('tags', $book->tags->pluck('id')->toArray()))->contains($tag->id)) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block font-medium">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border rounded px-3 py-2">{{ old('description', $book->description) }}</textarea>
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label class="block font-medium">Couverture</label>
                <input type="file" name="cover" class="w-full">

                @if($book->cover)
                    <img src="{{ asset('covers/'.$book->cover) }}"
                         class="mt-2 w-24 rounded">
                @endif
            </div>

            <!-- Bouton -->
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Mettre à jour
            </button>
        </form>

    </div>
</div>
@endsection
