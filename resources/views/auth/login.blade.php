@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h2>Login to Cinema</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required aria-describedby="email-error">
            @error('email')
                <p class="error" id="email-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required aria-describedby="password-error">
            @error('password')
                <p class="error" id="password-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Login</button>
        </div>
    </form>
    <div class="divider">OR</div>
    <a href="{{ route('google.login') }}" class="google-btn">
        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo">
        Sign in with Google
    </a>
    <p style="margin-top: 20px;">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
@endsection