@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero-section text-center" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%); border-radius: 20px; padding: 80px 20px 60px 20px; color: #fff; position: relative; margin-bottom: 4rem;">
    <h1 class="display-4 fw-bold mb-4">Welcome to Our Cinema</h1>
    <div class="d-flex justify-content-center mb-4">
        <div class="btn-group" role="group" aria-label="Toggle Dashboard/Movies">
            <a href="{{ route('profile') }}" class="btn btn-outline-light">Profile</a>
            <a href="{{ route('movies.index') }}" class="btn btn-light">Movies</a>
        </div>
    </div>
    <form class="d-flex justify-content-center mb-4" style="max-width: 600px; margin: 0 auto;" method="GET" action="{{ route('movies.index') }}">
        <input class="form-control form-control-lg rounded-start-pill" name="search" type="search" placeholder="Enter Movies or Series Title" aria-label="Search">
        <button class="btn btn-lg btn-light rounded-end-pill" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>
    <div class="mt-4 mb-2">
        <span class="fs-5">Have a look at our top rated Movies and TV Shows!</span>
        <i class="bi bi-arrow-down-circle ms-2 animate-bounce" style="font-size: 2rem;"></i>
    </div>
</div>

<section class="pt-8 pb-12">
    <div class="container">
        <h2 class="mb-4 fw-bold">Now Showing</h2>

        <div class="d-flex flex-wrap justify-content-start" style="gap: 20px;">
            @foreach ($movies as $movie)
                <x-movie-box :movie="$movie" />
            @endforeach
        </div>

       <div class="text-center mt-5">
    @auth
        <a href="{{ route('movies.index') }}" class="btn btn-outline-primary">See All Movies</a>
    @else
        <a href="{{ route('login') }}" class="btn btn-outline-primary">See All Movies</a>
    @endauth
</div>

    </div>
</section>




<!-- How it works Section -->
<div class="container py-5">
    <h2 class="fw-bold text-center mb-2" style="color: var(--primary-color);">How it works?</h2>
    <p class="text-center text-secondary mb-5">Feeling confused? Start here.</p>
    <div class="row g-4 justify-content-center">
        <div class="col-md-3 col-6 text-center">
            <div class="feature-icon mb-3">
                <i class="bi bi-film" style="font-size: 2.5rem; color: var(--accent-color);"></i>
            </div>
            <h5 class="fw-bold">Pick your movie</h5>
            <p class="small text-muted">Browse our collection. Don’t know what to watch? Check our <a href="#" class="text-decoration-none" style="color: var(--accent-color);">recommendations</a>.</p>
        </div>
        <div class="col-md-3 col-6 text-center">
            <div class="feature-icon mb-3">
                <i class="bi bi-ticket-perforated" style="font-size: 2.5rem; color: var(--accent-color);"></i>
            </div>
            <h5 class="fw-bold">Reserve your ticket</h5>
            <p class="small text-muted">Book your seat instantly for your favorite movie!</p>
        </div>
        <div class="col-md-3 col-6 text-center">
            <div class="feature-icon mb-3">
                <i class="bi bi-box-arrow-in-right" style="font-size: 2.5rem; color: var(--accent-color);"></i>
            </div>
            <h5 class="fw-bold">Register</h5>
            <p class="small text-muted">Create an account to reserve, pay for tickets, and receive news.</p>
        </div>
        <div class="col-md-3 col-6 text-center">
            <div class="feature-icon mb-3">
                <i class="bi bi-heart" style="font-size: 2.5rem; color: var(--accent-color);"></i>
            </div>
            <h5 class="fw-bold">Enjoy!</h5>
            <p class="small text-muted">Sit back and relax with snacks — your convenience matters most!</p>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container-fluid py-5" style="background: #f8f9fa;">
    <div class="row align-items-center">
        <div class="col-md-6 d-none d-md-block" style="background: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80') center/cover; min-height: 400px; border-radius: 20px 0 0 20px;"></div>
        <div class="col-md-6 bg-white p-5 rounded-end shadow-sm">
            <h3 class="fw-bold mb-3" style="color: var(--primary-color);">Watch all newest Movies once they get released!</h3>
 
            <p class="text-muted">Start booking tickets and never miss a premiere again.</p>
            <a class="btn btn-primary px-4 py-2" href="#" style="background-color: var(--accent-color); border: none;">Shows</a>
        </div>
    </div>
</div>


<style>
.movie-card {
  height: 100%; /* ensures card takes full height of container */
  display: flex;
  flex-direction: column;
}

.movie-card img.card-img-top {
  height: 500px; /* fixed height */
  object-fit: cover; /* cover image nicely */
  border-radius: 0.5rem 0.5rem 0 0;
  flex-shrink: 0;
}

.movie-card .card-body {
  flex-grow: 1; /* makes body fill remaining space */
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}


.feature-icon {
    transition: transform 0.3s ease;
}

.feature-icon:hover {
    transform: scale(1.1);
}

.animate-bounce {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}
</style>
@endsection
