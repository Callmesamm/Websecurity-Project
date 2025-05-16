@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="container-fluid py-5" style="min-height: 80vh;">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="position-relative w-100" style="max-width: 1200px; min-height: 480px;">
            <!-- More visible Backdrop -->
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('{{ $movie->backdrop_url ?? $movie->poster_url }}') center/cover no-repeat; filter: blur(3px) brightness(0.55); z-index:1;"></div>
            <div class="row g-0 align-items-center position-relative rounded-5 shadow-lg overflow-hidden mx-2 mx-md-4" style="backdrop-filter: blur(2px); background: rgba(44,62,80,0.65); z-index:2; min-height: 420px;">
                <div class="col-md-4 d-flex justify-content-center align-items-center p-4">
                    <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="rounded-4 shadow-lg" style="width: 220px; max-width: 100%; height: 320px; object-fit: cover; background: #fff;">
                </div>
                <div class="col-md-8 p-4 p-md-5 text-white">
                    <div class="d-flex align-items-center mb-3 gap-2 flex-wrap">
                        <span class="badge bg-warning text-dark fw-semibold" style="font-size:1.2rem;"><i class="bi bi-star-fill me-1"></i>{{ number_format($movie->vote_average, 1) }}</span>
                        <span class="badge bg-secondary" style="font-size:1.1rem;">{{ $movie->release_date->format('Y') }}</span>
                        <span class="badge bg-success" style="font-size:1.1rem;">{{ $movie->status }}</span>
                    </div>
                    <h1 class="fw-bold mb-2" style="font-size:2.5rem;">{{ $movie->title }}</h1>
                    @if($movie->tagline)
                        <div class="text-info fst-italic mb-3" style="font-size:1.2rem;">{{ $movie->tagline }}</div>
                    @endif
                    <div class="mb-4">
                        <h5 class="fw-bold mb-2 text-white">Overview</h5>
                        <p class="mb-0 text-white-50" style="font-size:1.1rem;">{{ $movie->overview }}</p>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6 col-md-4 mb-2">
                            <strong>Duration:</strong> <span class="text-white-50">{{ $movie->runtime }} min</span>
                        </div>
                        <div class="col-6 col-md-4 mb-2">
                            <strong>Status:</strong> <span class="text-white-50">{{ $movie->status }}</span>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <strong>IMDB:</strong> <span class="text-white-50">{{ $movie->imdb_id }}</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row gap-3 mb-3">
                        @auth
                            <button type="button" class="btn btn-lg btn-primary px-4 fw-bold shadow" id="bookNowBtn"><i class="bi bi-ticket-perforated me-2"></i>Book Now</button>
                        @else
                            <a href="{{ route('login') }}?redirect={{ route('movies.show', $movie->id) }}" class="btn btn-lg btn-primary px-4 fw-bold shadow"><i class="bi bi-box-arrow-in-right me-2"></i>Login to Book</a>
                        @endauth
                        <a href="{{ route('movies.index') }}" class="btn btn-outline-light btn-lg px-4 fw-bold shadow">← Back to Movies List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Showtimes Modal -->
<div class="modal fade" id="showtimesModal" tabindex="-1" aria-labelledby="showtimesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showtimesModalLabel">Available Showtimes for {{ $movie->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="showtimesList" class="d-flex flex-column gap-2">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 767px) {
    .rounded-5 { border-radius: 1.2rem !important; }
    .p-md-5 { padding: 1.2rem !important; }
}
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookNowBtn = document.getElementById('bookNowBtn');
        if (!bookNowBtn) return;
        const showtimesModal = new bootstrap.Modal(document.getElementById('showtimesModal'));
        const showtimesList = document.getElementById('showtimesList');
        
        bookNowBtn.addEventListener('click', function() {
            // Show modal
            showtimesModal.show();
            
            // Fetch showtimes
            fetch('{{ route("movies.showtimes", $movie->id) }}')
                .then(response => response.json())
                .then(data => {
                    // Clear loading spinner
                    showtimesList.innerHTML = '';
                    
                    if (data.length === 0) {
                        showtimesList.innerHTML = '<div class="alert alert-info">No showtimes available for this movie at the moment.</div>';
                        return;
                    }
                    
                    // Group showtimes by date
                    const groupedByDate = data.reduce((acc, show) => {
                        const date = show.date;
                        if (!acc[date]) {
                            acc[date] = [];
                        }
                        acc[date].push(show);
                        return acc;
                    }, {});
                    
                    // Display showtimes grouped by date
                    Object.keys(groupedByDate).forEach(date => {
                        const shows = groupedByDate[date];
                        const dateObj = new Date(date);
                        const formattedDate = dateObj.toLocaleDateString('en-US', { 
                            weekday: 'long', 
                            year: 'numeric', 
                            month: 'long', 
                            day: 'numeric' 
                        });
                        
                        const dateDiv = document.createElement('div');
                        dateDiv.className = 'card mb-3';
                        
                        const dateHeader = document.createElement('div');
                        dateHeader.className = 'card-header bg-primary text-white';
                        dateHeader.textContent = formattedDate;
                        
                        const dateBody = document.createElement('div');
                        dateBody.className = 'card-body';
                        
                        const timesRow = document.createElement('div');
                        timesRow.className = 'row g-2';
                        
                        shows.forEach(show => {
                            const startTime = new Date(`${show.date}T${show.start_time}`);
                            const timeCol = document.createElement('div');
                            timeCol.className = 'col-md-4 col-6';
                            
                            const timeCard = document.createElement('div');
                            timeCard.className = 'card text-center';
                            
                            const timeBody = document.createElement('div');
                            timeBody.className = 'card-body p-2';
                            
                            const timeBtn = document.createElement('button');
                            timeBtn.className = 'btn btn-sm btn-outline-primary w-100';
                            timeBtn.textContent = startTime.toLocaleTimeString('en-US', { 
                                hour: '2-digit', 
                                minute: '2-digit' 
                            });
                            timeBtn.dataset.showId = show.id;
                            timeBtn.addEventListener('click', function() {
                                // Handle booking logic here - could redirect to reservation page
                                window.location.href = `/reservations/create?show_id=${show.id}`;
                            });
                            
                            const priceInfo = document.createElement('small');
                            priceInfo.className = 'd-block mt-1 text-muted';
                            priceInfo.textContent = `$${show.price} - ${show.available_seats} seats left`;
                            
                            timeBody.appendChild(timeBtn);
                            timeBody.appendChild(priceInfo);
                            timeCard.appendChild(timeBody);
                            timeCol.appendChild(timeCard);
                            timesRow.appendChild(timeCol);
                        });
                        
                        dateBody.appendChild(timesRow);
                        dateDiv.appendChild(dateHeader);
                        dateDiv.appendChild(dateBody);
                        showtimesList.appendChild(dateDiv);
                    });
                })
                .catch(error => {
                    console.error('Error fetching showtimes:', error);
                    showtimesList.innerHTML = '<div class="alert alert-danger">Error loading showtimes. Please try again later.</div>';
                });
        });
    });
</script>
@endsection 