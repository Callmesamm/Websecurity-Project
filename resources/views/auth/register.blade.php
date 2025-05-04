@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <h2>Join Cinema</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required aria-describedby="name-error">
            @error('name')
                <p class="error" id="name-error">{{ $message }}</p>
            @enderror
        </div>
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
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Register</button>
        </div>
    </form>
    <div class="divider">OR</div>
    <a href="{{ route('google.login') }}" class="google-btn">
        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo">
        Sign up with Google
    </a>
    <p style="margin-top: 20px;">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
@endsection