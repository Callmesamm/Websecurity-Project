@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero-section text-center" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%); border-radius: 20px; padding: 80px 20px 60px 20px; color: #fff; position: relative; margin-bottom: 4rem;">
    <h1 class="display-4 fw-bold mb-4">Welcome to Our Cinema</h1>
    <div class="d-flex justify-content-center mb-4">
        <div class="btn-group" role="group" aria-label="Toggle Dashboard/Movies">
            <a href="{{ route('profile') }}" class="btn btn-outline-primary">Profile</a>
            <a href="{{ route('movies.index') }}" class="btn btn-primary">Movies</a>
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

<!-- Newest Movies Section -->
<div class="py-5" style="background: #f8f9fa;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2" style="color: var(--primary-color);">Newest Movies</h2>
        <p class="text-center text-secondary mb-5">View our latest movies collection.</p>
        <div class="row justify-content-center g-4">
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100 movie-card">
                    <div class="position-relative">
                        <img src="https://m.media-amazon.com/images/I/51k0qa6qH-L._AC_.jpg" class="card-img-top" alt="The Dark Knight">
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-warning text-dark">4.5/5</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-1">The Dark Knight</h5>
                        <div class="mb-2"><span class="text-muted">Action</span></div>
                        <p class="card-text small">Welcome to a world without rules. Gotham's only hope is the Dark Knight.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100 movie-card">
                    <div class="position-relative">
                        <img src="https://m.media-amazon.com/images/I/71niXI3lxlL._AC_SY679_.jpg" class="card-img-top" alt="The Shawshank Redemption">
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-warning text-dark">4.8/5</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-1">The Shawshank Redemption</h5>
                        <div class="mb-2"><span class="text-muted">Drama</span></div>
                        <p class="card-text small">Fear can hold you prisoner. Hope can set you free.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100 movie-card">
                    <div class="position-relative">
                        <img src="https://m.media-amazon.com/images/I/51oBxmV-dML._AC_.jpg" class="card-img-top" alt="The Godfather">
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-warning text-dark">4.7/5</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-1">The Godfather</h5>
                        <div class="mb-2"><span class="text-muted">Crime</span></div>
                        <p class="card-text small">An offer you can't refuse. The story of a mafia family.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100 movie-card">
                    <div class="position-relative">
                        <img src="https://m.media-amazon.com/images/I/61OUGpUfAyL._AC_SY679_.jpg" class="card-img-top" alt="Forrest Gump">
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-warning text-dark">4.6/5</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-1">Forrest Gump</h5>
                        <div class="mb-2"><span class="text-muted">Drama</span></div>
                        <p class="card-text small">Life is like a box of chocolates. You never know what you're gonna get.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
            <p class="small text-muted">Browse our extensive and exciting collection of movies. Still don't know what to watch? Take a look at our <a href="#" class="text-decoration-none" style="color: var(--accent-color);">recommendations</a>.</p>
        </div>
        <div class="col-md-3 col-6 text-center">
            <div class="feature-icon mb-3">
                <i class="bi bi-ticket-perforated" style="font-size: 2.5rem; color: var(--accent-color);"></i>
            </div>
            <h5 class="fw-bold">Reserve your ticket</h5>
            <p class="small text-muted">Reserve your ticket to your favourite movie!</p>
        </div>
        <div class="col-md-3 col-6 text-center">
            <div class="feature-icon mb-3">
                <i class="bi bi-box-arrow-in-right" style="font-size: 2.5rem; color: var(--accent-color);"></i>
            </div>
            <h5 class="fw-bold">Register</h5>
            <p class="small text-muted">Register your account to reserve and pay for tickets. Also to stay up to date with the latest offers and news.</p>
        </div>
        <div class="col-md-3 col-6 text-center">
            <div class="feature-icon mb-3">
                <i class="bi bi-heart" style="font-size: 2.5rem; color: var(--accent-color);"></i>
            </div>
            <h5 class="fw-bold">Enjoy!</h5>
            <p class="small text-muted">Enjoy your movie at one of our cinema rooms, order snacks while you're at it. Your convenience is our priority.</p>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container-fluid py-5" style="background: #f8f9fa;">
    <div class="row align-items-center">
        <div class="col-md-6 d-none d-md-block" style="background: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80') center/cover; min-height: 400px; border-radius: 20px 0 0 20px;"></div>
        <div class="col-md-6 bg-white p-5 rounded-end shadow-sm">
            <h3 class="fw-bold mb-3" style="color: var(--primary-color);">Watch all newest Movies once they get released!</h3>
            <p class="text-muted">Sign up or register now to reserve your own tickets. And get notified on new offers and news!</p>
            <a class="btn btn-primary px-4 py-2" href="{{ route('register') }}" style="background-color: var(--accent-color); border: none;">Register</a>
            <p class="text-muted">Start reserving your tickets to enjoy the latest and greatest movies!</p>
            <a class="btn btn-primary px-4 py-2" href="#" style="background-color: var(--accent-color); border: none;">Shows</a>
        </div>
    </div>
</div>

<!-- Subscribe Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 text-center">
            <h2 class="fw-bold mb-2" style="color: var(--primary-color);">Join Cinemat Now!</h2>
            <p class="text-secondary mb-4">Enter your email to be notified about any news and new offers!</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7 col-sm-10 col-12">
            <form method="POST" action="#" class="mt-4">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Your Email" autocomplete="off">
                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--accent-color); border: none;">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .movie-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .movie-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
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