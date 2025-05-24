@extends('layouts.app')

@section('title', 'My Reservations')

@section('content')
<style>
    .reservation-card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        overflow: hidden;
        margin-bottom: 20px;
        background: #fff;
    }
    .reservation-card:hover {
        transform: translateY(-5px);
    }
    .movie-poster {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .reservation-details {
        padding: 15px;
    }
    .reservation-status {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .status-confirmed {
        background-color: #d4edda;
        color: #155724;
    }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">My Reservations</h1>
        <a href="{{ route('profile') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-2"></i>Back to Profile
        </a>
    </div>

    @if($reservations->isEmpty())
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-ticket-perforated" style="font-size: 4rem; color: #6c757d;"></i>
            </div>
            <h4>No reservations yet</h4>
            <p class="text-muted">You haven't made any reservations yet. Book your movie tickets now!</p>
            <a href="{{ route('movies.index') }}" class="btn btn-primary mt-3">
                Browse Movies
            </a>
        </div>
    @else
        <div class="row">
            @foreach($reservations as $reservation)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="reservation-card h-100">
                        @if($reservation->show && $reservation->show->movie)
                            <img src="{{ asset('storage/' . $reservation->show->movie->image) }}" 
                                 alt="{{ $reservation->show->movie->title }}" 
                                 class="movie-poster">
                        @else
                            <div class="movie-poster bg-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-film" style="font-size: 3rem; color: #dee2e6;"></i>
                            </div>
                        @endif
                        
                        <div class="reservation-details">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="mb-1">
                                    {{ $reservation->show->movie->title ?? 'Movie not available' }}
                                </h5>
                                <span class="reservation-status status-confirmed">
                                    Confirmed
                                </span>
                            </div>
                            
                            @if($reservation->show)
                                <p class="mb-1">
                                    <i class="bi bi-calendar-event me-2"></i>
                                    {{ \Carbon\Carbon::parse($reservation->show->date)->format('M d, Y') }}
                                </p>
                                <p class="mb-1">
                                    <i class="bi bi-clock me-2"></i>
                                    {{ \Carbon\Carbon::parse($reservation->show->start_time)->format('g:i A') }}
                                </p>
                                <p class="mb-1">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    {{ $reservation->show->hall->name ?? 'Hall not specified' }}
                                </p>
                            @endif
                            
                            <div class="d-flex justify-content-between mt-3 pt-2 border-top">
                                <div>
                                    <small class="text-muted">Seat</small>
                                    <div class="fw-bold">#{{ $reservation->seat_number }}</div>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">Price</small>
                                    <div class="fw-bold">${{ number_format($reservation->price, 2) }}</div>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <small class="text-muted">
                                    Booked on {{ $reservation->created_at->format('M d, Y \a\t g:i A') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $reservations->links() }}
        </div>
    @endif
</div>
@endsection
