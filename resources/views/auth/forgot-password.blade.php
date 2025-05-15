@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
    <h2>Reset Your Password</h2>
    <p>Enter your email address to receive a password reset link.</p>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required aria-describedby="email-error">
            @error('email')
                <p class="error" id="email-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Send Reset Link</button>
        </div>
    </form>
    <p style="margin-top: 20px;">Remember your password? <a href="{{ route('login') }}">Login here</a></p>
@endsection