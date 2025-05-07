@extends('layouts.app')

@section('title', 'Movies')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Movies</h2>
    <div class="row g-4">
        @foreach($movies as $movie)
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ $movie->image ? asset('storage/'.$movie->image) : 'https://via.placeholder.com/200x300?text=No+Image' }}" class="card-img-top" alt="{{ $movie->title }}">
                    <div class="card-body">
                        <h5 class="card-title mb-1">{{ $movie->title }}</h5>
                        <div class="mb-2"><span class="text-warning">★ {{ number_format($movie->rating,1) }}/5</span> <span class="text-muted ms-2">{{ $movie->category }}</span></div>
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary btn-sm w-100">Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 