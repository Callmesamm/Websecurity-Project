@extends('layouts.app')

@section('title', 'Movies')

@section('content')
<div class="container px-2 px-md-4 py-4">
    <h1 class="text-3xl fw-bold mb-5 text-center">Popular Movies</h1>
    <div class="row g-4 justify-content-center">
        @foreach($movies as $movie)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <div class="card movie-tile border-0 shadow-sm w-100 position-relative overflow-hidden" style="background: linear-gradient(120deg, #232526 60%, #414345 100%); min-height: 370px;">
                    <div class="position-relative">
                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="card-img-top rounded-3" style="height: 320px; object-fit: cover; background: #fff;">
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-warning text-dark fw-semibold" style="font-size:1rem;"><i class="bi bi-star-fill me-1"></i>{{ number_format($movie->vote_average, 1) }}</span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title fw-bold text-white mb-1">{{ $movie->title }}</h5>
                        <div class="mb-2">
                            <span class="badge bg-secondary me-1">{{ $movie->release_date->format('Y') }}</span>
                            <span class="badge bg-success">{{ $movie->status }}</span>
                        </div>
                        <div class="text-white-50 fst-italic mb-2" style="font-size:0.95rem;">{{ $movie->tagline ?? '' }}</div>
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-outline-light btn-sm w-100 mt-auto">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-5 d-flex justify-content-center">
        <nav aria-label="Movies pagination">
            <ul class="pagination pagination-lg custom-pagination mb-0">
                @if ($movies->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $movies->previousPageUrl() }}" rel="prev">&laquo; Previous</a></li>
                @endif
                @foreach ($movies->getUrlRange(max($movies->currentPage()-2,1), min($movies->currentPage()+2, $movies->lastPage())) as $page => $url)
                    <li class="page-item {{ $page == $movies->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                @if ($movies->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $movies->nextPageUrl() }}" rel="next">Next &raquo;</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                @endif
            </ul>
        </nav>
    </div>
</div>

<style>
.movie-tile {
    transition: transform 0.22s cubic-bezier(.4,2,.6,1), box-shadow 0.22s;
    border-radius: 1.2rem;
    min-height: 370px;
    display: flex;
    flex-direction: column;
}
.movie-tile:hover {
    transform: translateY(-7px) scale(1.03);
    box-shadow: 0 8px 32px rgba(44,62,80,0.18);
    z-index: 2;
}
.custom-pagination .page-link {
    color: var(--primary-color);
    background: #fff;
    border: none;
    border-radius: 0.5rem;
    margin: 0 0.15rem;
    font-weight: 500;
    box-shadow: 0 2px 8px rgba(44,62,80,0.06);
    transition: background 0.2s, color 0.2s;
}
.custom-pagination .page-item.active .page-link,
.custom-pagination .page-link:hover {
    background: var(--primary-color);
    color: #fff;
}
.custom-pagination .page-item.disabled .page-link {
    color: #aaa;
    background: #f1f1f1;
}
</style>
@endsection 