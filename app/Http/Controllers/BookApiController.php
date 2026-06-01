<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BookApiController extends Controller
{
    public function index()
    {
        Log::info('Books API index called');

        $books = Book::all();
        return response()->json($books);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'auteur' => 'required',
            'annee' => 'required|integer'
        ]);

        $book = Book::create([
            'titre' => $request->titre,
            'auteur' => $request->auteur,
            'annee' => $request->annee
        ]);

        return response()->json($book, 201);
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
