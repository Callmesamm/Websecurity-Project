@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
    <div style="max-width: 400px; margin: 50px auto; padding: 20px;">
        <h2 style="text-align: center; margin-bottom: 30px; color: #333;">Verify Your Email Address</h2>
        @if (session('status'))
            <p style="color: green; text-align: center;">{{ session('status') }}</p>
        @endif
        @if (session('success'))
            <p style="color: green; text-align: center;">{{ session('success') }}</p>
        @endif
        <p style="text-align: center;">Before proceeding, please check your email for a verification link.</p>
        <p style="text-align: center;">If you did not receive the email, you can request another one below.</p>
        <form method="POST" action="{{ route('verification.resend') }}" style="display: flex; justify-content: center; margin-top: 20px;">
            @csrf
            <button type="submit" style="padding: 10px 20px; background-color: #333; color: white; border: none; border-radius: 4px; cursor: pointer;">Resend Verification Email</button>
        </form>
    </div>
@endsection