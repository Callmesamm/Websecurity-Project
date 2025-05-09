@extends('layouts.app')

@section('title', 'Movies')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">الأفلام الشائعة</h1>

    <div class="row justify-content-center g-4">
        @foreach($movies as $movie)
            <div class="col-md-4 col-lg-3 col-6">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="card-img-top" style="height: 320px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-1">{{ $movie->title }}</h5>
                        <div class="mb-2"><span class="text-warning">★ {{ number_format($movie->vote_average, 1) }}</span> <span class="text-muted ms-2">{{ $movie->release_date->format('Y') }}</span></div>
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary btn-sm w-100 mt-2">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $movies->links() }}
    </div>
</div>
@endsection 