<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;

class BorrowingController extends Controller
{
    public function borrowBook($id)
    {
        $book = Book::findOrFail($id);
        $user = auth()->user();

        // Check if the user hasn't borrowed the same book multiple times and if the book is available
        if (!$user->hasBorrowed($book) && $book->isAvailable()) {
            $dueDate = now()->addWeeks(2);

            Borrowing::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'due_date' => $dueDate,
            ]);

            return redirect()->route('books.index')->with('success', 'Book borrowed successfully.');
        } else {
            return redirect()->route('books.index')->with('error', 'Unable to borrow the book.');
        }
    }

    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        // Check if the book is due for return
        if ($borrowing->isDue()) {
            $borrowing->update(['returned_at' => now()]);

            return redirect()->route('books.index')->with('success', 'Book returned successfully.');
        } else {
            return redirect()->route('books.index')->with('error', 'Book is not due yet.');
        }
    }
}
