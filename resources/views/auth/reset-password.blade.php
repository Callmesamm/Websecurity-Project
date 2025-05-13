@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <h2>Create New Password</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required aria-describedby="email-error">
            @error('email')
                <p class="error" id="email-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" required aria-describedby="password-error">
            @error('password')
                <p class="error" id="password-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Reset Password</button>
        </div>
    </form>
    <p style="margin-top: 20px;">Remember your password? <a href="{{ route('login') }}">Login here</a></p>
@endsection