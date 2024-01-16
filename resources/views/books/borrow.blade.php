@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="title">Borrow Book</h1>

        <form method="POST" action="{{ route('books.borrow', $book->id) }}">
            @csrf

            <div class="field">
                <label class="label">Due Date</label>
                <div class="control">
                    <input class="input" type="text" value="{{ now()->addWeeks(2)->toDateString() }}" readonly>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">Borrow</button>
                </div>
            </div>
        </form>
    </div>
@endsection
