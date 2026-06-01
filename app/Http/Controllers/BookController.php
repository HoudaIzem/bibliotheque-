<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendBookMail;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $booksQuery = Book::query();
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $allowedSorts = ['created_at', 'designation', 'prix', 'auteur'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        $booksQuery->orderBy($sortBy, $sortDirection);
        if ($request->filled('type')) {
            $booksQuery->where('type_id', $request->type);
        }
        $books = $booksQuery->paginate(6)->withQueryString();

        return view('book.index', compact('books'));
    }

    public function search(Request $request)
    {
        $booksQuery = Book::with(['category', 'type', 'tags']);
        if ($request->filled('category')) {
            $booksQuery->where('category_id', $request->category);
        }
        if ($request->filled('type')) {
            $booksQuery->where('type_id', $request->type);
        }
        $sortBy = $request->get('sort');
        $sortDirection = $request->get('direction', 'asc');

        switch ($sortBy) {
            case 'title':
                $booksQuery->orderBy('designation', $sortDirection);
                break;
            case 'price':
                $booksQuery->orderBy('prix', $sortDirection);
                break;
            case 'created_at':
                $booksQuery->orderBy('created_at', $sortDirection);
                break;
            case 'type':
                $booksQuery->orderBy('type_id', $sortDirection);
                break;
            default:
                $booksQuery->orderBy('created_at', 'desc');
        }
        $books = $booksQuery->paginate(10)->withQueryString();
        $categories = \App\Models\Category::all();
        $types = \App\Models\Type::all();

        return view('books', compact('books', 'categories', 'types'));
    }


    public function create()
    {
        \Illuminate\Support\Facades\Gate::authorize('create', Book::class);
        $categories = \App\Models\Category::all();
        $types      = \App\Models\Type::all();
        $tags       = \App\Models\Tag::all();

        return view('book.create', compact('categories', 'types', 'tags'));
    }

    public function store(Request $request)
    {
        \Illuminate\Support\Facades\Gate::authorize('create', Book::class);

        $request->validate([
            'designation' => 'required',
            'auteur' => 'required',
            'prix' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'type_id' => 'nullable|exists:types,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'cover' => 'nullable|image|mimes:jpg,png,jpeg,webp',
        ]);

        $coverName = null;

        if ($request->hasFile('cover')) {
            $coverName = time() . '.' . $request->cover->extension();
            $request->cover->move(public_path('covers'), $coverName);
        }

        $book = Book::create([
            'designation' => $request->designation,
            'auteur' => $request->auteur,
            'prix' => $request->prix,
            'description' => $request->description,
            'cover' => $coverName,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id,
        ]);

        if ($request->filled('tags')) {
            $book->tags()->sync($request->tags);
        }

        return redirect()->route('book.index')
            ->with('success', 'Livre ajouté avec succès');
    }

    public function show(string $id)
    {
        $book = Book::with(['category', 'type', 'tags'])->findOrFail($id);
        return view('book.show', compact('book'));
    }

    public function send(string $id)
    {
        $book = Book::with(['category', 'type', 'tags'])->findOrFail($id);
        return view('book.send', compact('book'));
    }

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        \Illuminate\Support\Facades\Gate::authorize('update', $book);

        $categories = \App\Models\Category::all();
        $types      = \App\Models\Type::all();
        $tags       = \App\Models\Tag::all();

        return view('book.edit', compact('book', 'categories', 'types', 'tags'));
    }

    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        \Illuminate\Support\Facades\Gate::authorize('update', $book);

        $request->validate([
            'designation' => 'required|string|max:255',
            'auteur'      => 'required|string|max:255',
            'prix'        => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'type_id'     => 'nullable|exists:types,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
            'description' => 'nullable|string',
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $book->designation = $request->designation;
        $book->auteur = $request->auteur;
        $book->prix = $request->prix;
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->type_id = $request->type_id;

        if ($request->hasFile('cover')) {

            if ($book->cover && file_exists(public_path('covers/' . $book->cover))) {
                unlink(public_path('covers/' . $book->cover));
            }

            $image = $request->file('cover');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('covers'), $imageName);

            $book->cover = $imageName;
        }

        $book->save();

        if ($request->filled('tags')) {
            $book->tags()->sync($request->tags);
        } else {
            $book->tags()->detach();
        }

        return redirect()
            ->route('book.index')
            ->with('success', 'Livre mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        \Illuminate\Support\Facades\Gate::authorize('delete', $book);

        if ($book == null) {
            return redirect()->back()->with('error', 'Le livre n\'existe pas.');
        }

        if ($book->cover && $book->cover != 'no_cover.jpg') {
            if (file_exists(public_path('covers/' . $book->cover))) {
                unlink(public_path('covers/' . $book->cover));
            }
        }

        $book->delete();

        return redirect()
            ->route('book.index')
            ->with('success', 'Livre supprimé avec succès.');
    }

    public function sendMail(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $book = Book::with(['category', 'type', 'tags'])->findOrFail($id);

        Mail::to($request->email)->send(new SendBookMail($book));

        return back()->with('success', 'Book sent successfully to email!');
    }

    public function buy(string $id)
    {
        $book = Book::findOrFail($id);

        return back()->with('success', 'Le livre "' . $book->designation . '" a été acheté avec succès!');
    }
}
