@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="notification is-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="notification is-danger">
            {{ session('error') }}
        </div>
    @endif

    <books-index></books-index>
@endsection
