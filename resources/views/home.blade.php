@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h2>Welcome, {{ Auth::user()->name }}!</h2>
    <p>This is your dashboard.</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn">Logout</button>
    </form>
@endsection