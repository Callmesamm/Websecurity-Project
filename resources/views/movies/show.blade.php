@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm">
                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="card-img-top" style="height: 420px; object-fit: cover;">
                <div class="card-body">
                    <h3 class="card-title mb-2">{{ $movie->title }}</h3>
                    <div class="mb-2"><span class="text-warning">★ {{ number_format($movie->vote_average, 1) }}</span> <span class="text-muted ms-2">{{ $movie->release_date->format('Y') }}</span></div>
                    @if($movie->tagline)
                        <p class="text-primary small mb-2">{{ $movie->tagline }}</p>
                    @endif
                    <p class="card-text mb-3">{{ $movie->overview }}</p>
                    <div class="mb-3">
                        <strong>المدة:</strong> {{ $movie->runtime }} دقيقة
                    </div>
                    <div class="mb-3">
                        <strong>الحالة:</strong> {{ $movie->status }}
                    </div>
                    <div class="mb-3">
                        <strong>IMDB:</strong> {{ $movie->imdb_id }}
                    </div>
                    
                    <div class="d-grid gap-2 mb-3">
                        @auth
                            <button type="button" class="btn btn-primary btn-lg" id="bookNowBtn">Book Now</button>
                        @else
                            <a href="{{ route('login') }}?redirect={{ route('movies.show', $movie->id) }}" class="btn btn-primary btn-lg">Login to Book</a>
                        @endauth
                    </div>
                    
                    <a href="{{ route('movies.index') }}" class="btn btn-secondary w-100">رجوع لقائمة الأفلام</a>
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

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookNowBtn = document.getElementById('bookNowBtn');
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