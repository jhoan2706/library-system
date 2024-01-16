<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function booksIndexPage()
    {
        $books = Book::paginate(10);

        return view('books.index', compact('books'));
    }

    public function searchPage(Request $request)
    {

        $isLibrarian = Auth::check() && Auth::user()->isLibrarian();

        return view('books.search', compact('isLibrarian'));
    }

    public function AddPage()
    {
        return view('books.create');
    }

    public function editPage($id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit', compact('book'));
    }


    public function getAllBooks()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn',
            'total_copies' => 'required|integer|min:1',
        ]);

        // Create book
        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        // Validation
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $id,
            'total_copies' => 'required|integer|min:1',
        ]);

        // Update book
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $book->update($request->all());

        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Add a check if the user is a librarian
        if (Auth::check() && Auth::user()->isLibrarian()) {
            $book->delete();
            return redirect()->route('books.index')->with('success', 'Book deleted successfully');
        } else {
            return redirect()->route('books.index')->with('error', 'Unauthorized to delete book');
        }
    }
}
