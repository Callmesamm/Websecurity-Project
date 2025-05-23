@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div style="max-width: 400px; margin: 50px auto; padding: 20px;">
        <h2 style="text-align: center; margin-bottom: 30px; color: #333;">Join Cinema</h2>
        @if(session('error'))
            <p style="color: red; text-align: center;">{{ session('error') }}</p>
        @endif
        <form method="POST" action="{{ route('register') }}" style="display: flex; flex-direction: column;">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="first_name" style="display: block; margin-bottom: 5px; color: #333;">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" aria-describedby="first_name-error">
                @error('first_name')
                    <p class="error" id="first_name-error" style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label for="last_name" style="display: block; margin-bottom: 5px; color: #333;">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" aria-describedby="last_name-error">
                @error('last_name')
                    <p class="error" id="last_name-error" style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; color: #333;">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" aria-describedby="email-error">
                @error('email')
                    <p class="error" id="email-error" style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; margin-bottom: 5px; color: #333;">Password</label>
                <input type="password" name="password" id="password" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" aria-describedby="password-error">
                @error('password')
                    <p class="error" id="password-error" style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label for="password_confirmation" style="display: block; margin-bottom: 5px; color: #333;">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <button type="submit" style="width: 100%; padding: 10px; background-color: #333; color: white; border: none; border-radius: 4px; cursor: pointer;">Register</button>
            </div>
        </form>
        <div style="text-align: center; margin: 15px 0; color: #333;">OR</div>
        <a href="{{ route('google.login') }}" class="google-btn" style="display: flex; align-items: center; justify-content: center; text-decoration: none; color: #333; border: 1px solid #ccc; padding: 10px; border-radius: 4px;">
            <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" style="height: 20px; margin-right: 10px;">
            Sign up with Google
        </a>
        <p style="text-align: center; margin-top: 20px;">Already have an account? <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none;">Login here</a></p>
    </div>
@endsection