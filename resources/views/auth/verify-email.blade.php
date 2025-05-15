@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
    <h2>Verify Your Email Address</h2>
    <p>Before proceeding, please check your email for a verification link.</p>
    <p>If you did not receive the email, <a href="{{ route('verification.resend') }}">click here to request another</a>.</p>
@endsection