@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="title">Return Book</h1>

        <form method="POST" action="{{ route('books.return', $borrowing->id) }}">
            @csrf

            <div class="field">
                <label class="label">Due Date</label>
                <div class="control">
                    <input class="input" type="text" value="{{ $borrowing->due_date }}" readonly>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">Return</button>
                </div>
            </div>
        </form>
    </div>
@endsection
