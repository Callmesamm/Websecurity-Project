@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-4">
            <img src="{{ $movie->image ? asset('storage/'.$movie->image) : 'https://via.placeholder.com/300x450?text=No+Image' }}" class="img-fluid rounded shadow-sm" alt="{{ $movie->title }}">
        </div>
        <div class="col-md-8">
            <h2 class="fw-bold">{{ $movie->title }}</h2>
            <div class="mb-2"><span class="text-warning">★ {{ number_format($movie->rating,1) }}/5</span> <span class="text-muted ms-2">{{ $movie->category }}</span></div>
            <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>
            <p><strong>Duration:</strong> {{ $movie->duration }} min</p>
            <p>{{ $movie->storyline }}</p>
        </div>
    </div>
    <h4 class="mb-3">Reserve your ticket!</h4>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Start time</th>
                    <th>End time</th>
                    <th>Ticket price</th>
                    <th>Remaining seats</th>
                    <th>Reserve</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movie->shows as $show)
                <tr>
                    <td>{{ $show->date }}</td>
                    <td>{{ $show->start_time }}</td>
                    <td>{{ $show->end_time }}</td>
                    <td>{{ $show->price }} EGP</td>
                    <td>{{ $show->available_seats }}/{{ $show->total_seats }}</td>
                    <td>
                        @if($show->available_seats > 0)
                        <form method="POST" action="{{ route('reservations.store') }}" class="d-flex align-items-center gap-2">
                            @csrf
                            <input type="hidden" name="show_id" value="{{ $show->id }}">
                            <input type="number" name="seat_number" min="1" max="{{ $show->total_seats }}" class="form-control form-control-sm" placeholder="Seat #" required style="width: 80px;">
                            <button type="submit" class="btn btn-success btn-sm">Reserve</button>
                        </form>
                        @else
                        <span class="text-danger">Full</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger mt-3">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
</div>
@endsection 