<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // GET /dashboard - only the logged-in user's books, newest first
    public function index()
    {
        $books = Book::where('user_id', auth()->id())
            ->latest()
            ->orderByDesc('id')
            ->get();

        return view('dashboard', compact('books'));
    }

    // POST /books - validate, assign user_id, save, redirect
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'  => 'required|string|max:150',
            'author' => 'required|string|max:100',
            'pages'  => 'required|integer|min:1|max:10000',
        ]);

        $validated['user_id'] = auth()->id();

        Book::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Book registered successfully.');
    }
}
