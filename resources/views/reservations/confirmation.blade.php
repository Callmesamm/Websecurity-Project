@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h2>Thank you for your booking!</h2>
    <p>Your payment has been received and your seats are confirmed.</p>
    <a href="{{ route('movies.index') }}" class="btn btn-primary mt-3">Back to Movies</a>
</div>
@endsection
