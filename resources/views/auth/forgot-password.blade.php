@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
    <div style="max-width: 400px; margin: 50px auto; padding: 20px;">
        <h2 style="text-align: center; margin-bottom: 30px; color: #333;">Reset Your Password</h2>
        <p style="text-align: center;">Enter your email address to receive a password reset link.</p>
        @if (session('status'))
            <p style="color: green; text-align: center;">{{ session('status') }}</p>
        @endif
        @if (session('success'))
            <p style="color: green; text-align: center;">{{ session('success') }}</p>
        @endif
        <form method="POST" action="{{ route('password.email') }}" style="display: flex; flex-direction: column;">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; color: #333;">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" aria-describedby="email-error">
                @error('email')
                    <p class="error" id="email-error" style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <button type="submit" style="width: 100%; padding: 10px; background-color: #333; color: white; border: none; border-radius: 4px; cursor: pointer;">Send Reset Link</button>
            </div>
        </form>
        <p style="text-align: center; margin-top: 20px;">Remember your password? <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none;">Login here</a></p>
    </div>
@endsection