<!-- librarian.dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <h1 class="title">Librarian Dashboard</h1>

    <a href="{{ route('books.create') }}" class="button is-primary">Add New Book</a>

    <!-- Display other librarian dashboard content -->
    <div>Total Books: {{ $totalBooks }}</div>
    <div>Total Borrowed Books: {{ $totalBorrowedBooks }}</div>
    <div>Books Due Today: {{ $booksDueToday }}</div>

    <h2 class="subtitle">Members with Overdue Books:</h2>
    <ul>
        @foreach ($membersWithOverdueBooks as $member)
            <li>{{ $member->name }} - {{ $member->overdue_books }} overdue books</li>
        @endforeach
    </ul>

    <!-- List of books -->
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>ISBN</th>
                <th>Total Copies</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->total_copies }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="button is-info">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No books found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Display pagination links -->
    {{ $books->links() }}
@endsection
