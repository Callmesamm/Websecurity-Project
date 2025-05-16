@extends('layouts.app')

@section('title', 'Dashboard')

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
        <div class="profile-card p-3 mt-4 position-relative">
            <div class="text-center">
                <img src="https://www.gravatar.com/avatar/?d=mp" alt="avatar" class="profile-avatar mb-2" />
                <h3 class="fw-bold mt-2 mb-1" style="color:#2980b9;">customer</h3>
                <div class="text-muted mb-3">customer@cinemat.com</div>
            </div>
            <form class="mt-2">
                <div class="mb-3">
                    <label class="form-label">First name</label>
                    <input type="text" class="form-control rounded-pill" value="customer">
                </div>
                <div class="mb-3">
                    <label class="form-label">Last name</label>
                    <input type="text" class="form-control rounded-pill">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control rounded-pill">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm password</label>
                    <input type="password" class="form-control rounded-pill">
                </div>
                <button type="submit" class="btn btn-lg w-100 text-white rounded-pill mb-2" style="background:#2980b9; font-weight:bold;">Save Changes</button>
                <a href="#" class="btn btn-outline-secondary w-100 rounded-pill">Cancel</a>
            </form>
            <div class="mt-3 text-center">
                <a href="#" class="btn btn-link text-decoration-none" style="color:#2980b9;"><i class="bi bi-ticket-perforated me-2"></i>View My Reservations</a>
            </div>
        </div>
    </div>
</div>
@endsection 