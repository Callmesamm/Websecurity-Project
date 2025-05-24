@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<style>
    .dashboard-bg {
        background: linear-gradient(120deg, #e3eafc 60%, #f8fafc 100%);
        min-height: 100vh;
        padding-top: 24px;
        padding-bottom: 24px;
    }
    .profile-card {
        border-radius: 18px;
        box-shadow: 0 4px 16px rgba(44, 62, 80, 0.08);
        background: #fff;
        max-width: 340px;
        margin: auto;
        padding: 1.5rem 1.2rem !important;
    }
    .profile-avatar {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #2980b9;
        margin-top: -40px;
        background: #fff;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
    }
    .profile-card h3 {
        font-size: 1.2rem;
        margin-bottom: 0.25rem;
    }
    .profile-card .text-muted {
        font-size: 0.95rem;
    }
    .profile-card form .mb-3 {
        margin-bottom: 0.7rem !important;
    }
    .profile-card .btn {
        font-size: 0.98rem;
        padding: 0.5rem 0;
    }
    .profile-card .btn-lg {
        font-size: 1rem;
        padding: 0.6rem 0;
    }
</style>
<div class="dashboard-bg">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="profile-card p-3 mt-4 position-relative">
            <div class="text-center">
                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}?d=mp" alt="avatar" class="profile-avatar mb-2" />
                <h3 class="fw-bold mt-2 mb-1" style="color:#2980b9;">{{ $user->first_name }} {{ $user->last_name }}</h3>
                <div class="text-muted mb-3">{{ $user->email }}</div>
                <div class="text-muted mb-3">Role: {{ $user->roles->pluck('name')->implode(', ') }}</div>
            </div>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label class="form-label">First name</label>
                    <input type="text" name="first_name" class="form-control rounded-pill @error('first_name') is-invalid @enderror" value="{{ old('first_name', $user->first_name) }}">
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Last name</label>
                    <input type="text" name="last_name" class="form-control rounded-pill @error('last_name') is-invalid @enderror" value="{{ old('last_name', $user->last_name) }}">
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control rounded-pill @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm password</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-pill">
                </div>
                <button type="submit" class="btn btn-lg w-100 text-white rounded-pill mb-2" style="background:#2980b9; font-weight:bold;">Save Changes</button>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 rounded-pill">Cancel</a>
            </form>
            <div class="mt-3 text-center">
                <a href="{{ route('reservations.index') }}" class="btn btn-link text-decoration-none d-block mb-2" style="color:#2980b9;">
                    <i class="bi bi-ticket-perforated me-2"></i>View My Reservations
                </a>
                
                @if(auth()->user()->roles->contains('id', 1))
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary d-block">
                        <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection