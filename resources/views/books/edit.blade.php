@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="title">Edit Book</h1>

        <edit-book :book="{{ $book }}"></edit-book>
    </div>
@endsection
