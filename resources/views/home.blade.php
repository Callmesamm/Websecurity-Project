@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="text-center" style="background: linear-gradient(135deg, #b224ef 0%, #7579ff 100%); border-radius: 20px; padding: 60px 20px 40px 20px; color: #fff; position: relative;">
    <h1 class="display-4 fw-bold mb-4">WELCOME TO CINEMAT</h1>
    <form class="d-flex justify-content-center mb-4" style="max-width: 600px; margin: 0 auto;">
        <input class="form-control form-control-lg rounded-start-pill" type="search" placeholder="Enter Movies or Series Title" aria-label="Search">
        <button class="btn btn-lg btn-light rounded-end-pill" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>
    <div class="mt-3 mb-4">
        <span>Have a look at our top rated Movies and TV Shows!</span>
        <i class="bi bi-arrow-down-circle ms-2" style="font-size: 2rem;"></i>
    </div>
</div>

<!-- Newest Movies Section -->
<div class="py-5" style="background: #f6fbff;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2" style="color: #3a3a3a;">Newest Movies</h2>
        <p class="text-center text-secondary mb-4">View our latest movies collection.</p>
        <div class="row justify-content-center g-4">
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://m.media-amazon.com/images/I/51k0qa6qH-L._AC_.jpg" class="card-img-top" alt="The Dark Knight">
                    <div class="card-body">
                        <h5 class="card-title mb-1">The Dark Knight</h5>
                        <div class="mb-2"><span class="text-warning">★ 4.5/5</span> <span class="text-muted ms-2">Action</span></div>
                        <p class="card-text small">Welcome to a world without rules. Gotham's only hope is the Dark Knight.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://m.media-amazon.com/images/I/71niXI3lxlL._AC_SY679_.jpg" class="card-img-top" alt="The Shawshank Redemption">
                    <div class="card-body">
                        <h5 class="card-title mb-1">The Shawshank Redemption</h5>
                        <div class="mb-2"><span class="text-warning">★ 4.8/5</span> <span class="text-muted ms-2">Drama</span></div>
                        <p class="card-text small">Fear can hold you prisoner. Hope can set you free.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://m.media-amazon.com/images/I/51oBxmV-dML._AC_.jpg" class="card-img-top" alt="The Godfather">
                    <div class="card-body">
                        <h5 class="card-title mb-1">The Godfather</h5>
                        <div class="mb-2"><span class="text-warning">★ 4.7/5</span> <span class="text-muted ms-2">Crime</span></div>
                        <p class="card-text small">An offer you can't refuse. The story of a mafia family.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://m.media-amazon.com/images/I/61OUGpUfAyL._AC_SY679_.jpg" class="card-img-top" alt="Forrest Gump">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Forrest Gump</h5>
                        <div class="mb-2"><span class="text-warning">★ 4.6/5</span> <span class="text-muted ms-2">Drama</span></div>
                        <p class="card-text small">Life is like a box of chocolates. You never know what you're gonna get.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- How it works Section -->
<div class="container py-5">
    <h2 class="fw-bold text-center mb-2" style="color: #3a3a3a;">How it works?</h2>
    <p class="text-center text-secondary mb-5">Feeling confused? start here.</p>
    <div class="row g-4 justify-content-center">
        <div class="col-md-3 col-6 text-center">
            <div class="mb-3"><i class="bi bi-film" style="font-size: 2.5rem; color: #a259ec;"></i></div>
            <h5>Pick your movie</h5>
            <p class="small">Browse our extensive and exciting collection of movies. Still don't know what to watch? take a look at our <a href="#" class="text-primary">recommendations</a>.</p>
        </div>
        <div class="col-md-3 col-6 text-center">
            <div class="mb-3"><i class="bi bi-ticket-perforated" style="font-size: 2.5rem; color: #a259ec;"></i></div>
            <h5>Reserve your ticket</h5>
            <p class="small">Reserve your ticket to your favourite movie!</p>
        </div>
        <div class="col-md-3 col-6 text-center">
            <div class="mb-3"><i class="bi bi-box-arrow-in-right" style="font-size: 2.5rem; color: #a259ec;"></i></div>
            <h5>Register</h5>
            <p class="small">Register your account to reserve and pay for tickets. Also to stay up to date with the latest offers and news.</p>
        </div>
        <div class="col-md-3 col-6 text-center">
            <div class="mb-3"><i class="bi bi-heart" style="font-size: 2.5rem; color: #a259ec;"></i></div>
            <h5>Enjoy!</h5>
            <p class="small">Enjoy your movie at one of our cinema rooms, order snacks while you're at it. Your convinence is our priority.</p>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container-fluid py-5" style="background: #eaf6fb;">
    <div class="row align-items-center">
        <div class="col-md-6 d-none d-md-block" style="background: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80') center/cover; min-height: 350px; border-radius: 20px 0 0 20px;"></div>
        <div class="col-md-6 bg-white p-5 rounded-end">
            <h3 class="fw-bold mb-3">Watch all newest Movies once they get released!</h3>
            @guest
                <p>Sign up or register now to reserve your own tickets. And get notified on new offers and news!</p>
                <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
            @endguest
            @auth
                <p>Start reserving your tickets to enjoy the latest and greatest movies!</p>
                <a class="btn btn-primary" href="#">Shows</a>
            @endauth
        </div>
    </div>
</div>

<!-- Subscribe Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 text-center">
            @guest
                <h2 class="fw-bold mb-2">Join Cinemat Now!</h2>
                <p class="text-secondary mb-4">Enter your email to be notified about any news and new offers!</p>
            @endguest
            @auth
                <h2 class="fw-bold mb-2">Thanks For Using {{ config('app.name') }}!</h2>
                <p class="text-secondary mb-4">We hope you enjoy your experience with us!</p>
            @endauth
        </div>
    </div>
    @guest
    <div class="row justify-content-center">
        <div class="col-md-7 col-sm-10 col-12">
            <form method="POST" action="#" class="mt-4">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" autocomplete="off">
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
    @endguest
</div>
@endsection