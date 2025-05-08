@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-bg {
        background: linear-gradient(120deg, #e3eafc 60%, #f8fafc 100%);
        min-height: 100vh;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .profile-card {
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(44, 62, 80, 0.08);
        background: #fff;
        max-width: 480px;
        margin: auto;
    }
    .profile-avatar {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #2980b9;
        margin-top: -60px;
        background: #fff;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
    }
</style>
<div class="dashboard-bg">
    <div class="container">
        <div class="profile-card p-4 p-md-5 mt-5 position-relative">
            <div class="text-center">
                <img src="https://www.gravatar.com/avatar/?d=mp" alt="avatar" class="profile-avatar mb-2" />
                <h3 class="fw-bold mt-3 mb-1" style="color:#2980b9;">customer</h3>
                <div class="text-muted mb-4">customer@cinemat.com</div>
            </div>
            <form class="mt-4">
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
            <div class="mt-4 text-center">
                <a href="#" class="btn btn-link text-decoration-none" style="color:#2980b9;"><i class="bi bi-ticket-perforated me-2"></i>View My Reservations</a>
            </div>
        </div>
    </div>
</div>
@endsection 