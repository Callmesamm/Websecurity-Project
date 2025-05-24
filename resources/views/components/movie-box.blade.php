@props(['movie'])

<div class="movie-card shadow-sm border-0" style="width: 15rem; margin: 10px;">
    <a href="{{ route('movies.show', $movie->id) }}" class="text-decoration-none text-dark d-block">
        <img 
            src="{{ $movie->poster_url }}" 
            alt="{{ $movie->title }}" 
            style="width: 100%; height: 430px; object-fit: cover; border-radius: 0.5rem 0.5rem 0 0;"
        >
        <div class="card-body p-3">
            <h5 class="card-title mb-2" style="font-size: 1.15rem;">{{ $movie->title }}</h5>
            <p class="card-text text-muted small mb-0">{{ Str::limit($movie->description, 90) }}</p>
        </div>
    </a>
</div>
