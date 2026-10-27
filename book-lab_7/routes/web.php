<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
 * KEEP your existing login / register / logout routes (from your auth
 * project). Only the dashboard route is replaced: delete the old
 * Route::get('/dashboard', ...) so there is no duplicate.
 */

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BookController::class, 'index'])->name('dashboard');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
});

// require __DIR__.'/auth.php';   // <- keep this line if your project uses Breeze
