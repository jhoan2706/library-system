<!-- resources/views/member/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <h1 class="title">Member Dashboard</h1>

    <h2 class="subtitle">Your Borrowed Books:</h2>
    <ul>
        @foreach ($borrowedBooks as $borrowing)
            <li>
                {{ $borrowing->book->title }} - Due Date: {{ $dueDates[$borrowing->book_id] }}
                @if ($borrowing->isOverdue())
                    <span class="has-text-danger">Overdue</span>
                @else
                    <span class="has-text-success">On Time</span>
                @endif
                <!-- Add a link or button to return the book -->
                <a href="{{ route('books.return', ['borrowingId' => $borrowing->id]) }}" class="button is-danger">Return</a>
            </li>
        @endforeach
    </ul>

    <h2 class="subtitle">Overdue Books:</h2>
    <ul>
        @foreach ($overdueBooks as $borrowing)
            <li>
                {{ $borrowing->book->title }} - Due Date: {{ $dueDates[$borrowing->book_id] }}
                <span class="has-text-danger">Overdue</span>
                <!-- Add a link or button to return the overdue book -->
                <a href="{{ route('books.return', ['borrowingId' => $borrowing->id]) }}" class="button is-danger">Return</a>
            </li>
        @endforeach
    </ul>
@endsection
