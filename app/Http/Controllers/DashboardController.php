<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function librarianDashboard()
    {
        $totalBooks = Book::count();
        $totalBorrowedBooks = Borrowing::whereNull('returned_at')->count();
        $booksDueToday = Borrowing::whereDate('due_date', today())->count();

        // Get paginated list of books
        $books = Book::paginate(10);

        $membersWithOverdueBooks = Borrowing::where('due_date', '<', today())
            ->groupBy('user_id')
            ->orderByDesc('overdue_books')
            ->take(5)
            ->get([
                'user_id',
                DB::raw('count(*) as overdue_books')
            ]);

        return view('librarian.dashboard', compact('totalBooks', 'totalBorrowedBooks', 'booksDueToday', 'membersWithOverdueBooks', 'books'));
    }


    public function memberDashboard()
    {
        $user = auth()->user();

        $borrowedBooks = Borrowing::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->get();

        $dueDates = $borrowedBooks->pluck('due_date', 'book_id');

        $overdueBooks = $borrowedBooks->filter(function ($borrowing) {
            return $borrowing->due_date < today();
        });

        return view('member.dashboard', compact('borrowedBooks', 'dueDates', 'overdueBooks'));
    }
}
