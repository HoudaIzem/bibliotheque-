<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocaleController;

/*
|--------------------------------------------------------------------------
| LANGUAGE / LOCALE ROUTES
|--------------------------------------------------------------------------
| Handle language switching for the application
*/
Route::get('/locale/{locale}', [LocaleController::class, 'change'])->name('locale.change');

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
| Routes for pages that don't require authentication
*/
Route::get('/', function () {
    // Load categories for the homepage
    $categories = \App\Models\Category::all();
    return view('index', compact('categories'));
})->name('index');

Route::get('/contact', function(){
    // Find the contact page content
    $page = \App\Models\Page::where('slug','contact')->first();
    return view('contact', compact('page'));
})->name('contact');

Route::get('/about', function(){
    // Find the about page content
    $page = \App\Models\Page::where('slug','about')->first();
    return view('about', compact('page'));
})->name('about');

/*
|--------------------------------------------------------------------------
| BOOK ROUTES
|--------------------------------------------------------------------------
| Routes for book browsing and management
*/
Route::get('/books', [BookController::class, 'search'])->name('books');

Route::get('/books/details', function(){
    return view('books.details');
})->name('details');

// Resource routes for CRUD operations on books
Route::resource('book', BookController::class);

/*
|--------------------------------------------------------------------------
| TEST ROUTES
|--------------------------------------------------------------------------
| Temporary routes for development testing
*/
Route::get('/test-books', function () {
    return \App\Models\Book::all();
});


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/book/{id}/send', [BookController::class, 'sendMail'])->name('book.send.mail');
Route::post('/book/{id}/buy', [BookController::class, 'buy'])->name('book.buy');

require __DIR__.'/auth.php';
