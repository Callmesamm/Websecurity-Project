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
                    <a href="{{ route('movies.index') }}" class="btn btn-secondary w-100">رجوع لقائمة الأفلام</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 