@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<style>
    .contact-bg {
        background: linear-gradient(120deg, #e3eafc 60%, #f8fafc 100%);
        min-height: 100vh;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .contact-card {
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(44, 62, 80, 0.08);
        background: #fff;
    }
    .info-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #2980b9;
        color: #fff;
        font-size: 1.5em;
        margin-right: 16px;
    }
</style>
<div class="contact-bg">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 col-lg-6">
                <div class="contact-card p-4 p-md-5 mb-4">
                    <h2 class="fw-bold mb-4 text-center" style="color:#2980b9;">Let's Get In Touch</h2>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" class="form-control rounded-pill" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control rounded-pill" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" class="form-control rounded-pill" placeholder="Subject">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control rounded-4" rows="4" placeholder="Type your message..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-lg w-100 text-white rounded-pill" style="background:#2980b9; font-weight:bold;">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contact-card p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex align-items-center flex-fill mb-2 mb-md-0">
                        <span class="info-icon"><i class="bi bi-telephone"></i></span>
                        <div>
                            <div class="fw-bold">Phone</div>
                            <div class="text-muted">(123) 123-456</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-fill mb-2 mb-md-0">
                        <span class="info-icon"><i class="bi bi-envelope-paper"></i></span>
                        <div>
                            <div class="fw-bold">E-Mail</div>
                            <div class="text-muted">info@127.0.0.1:8000</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-fill mb-2 mb-md-0">
                        <span class="info-icon"><i class="bi bi-globe"></i></span>
                        <div>
                            <div class="fw-bold">Web</div>
                            <div class="text-muted">127.0.0.1:8000</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-fill">
                        <span class="info-icon"><i class="bi bi-printer"></i></span>
                        <div>
                            <div class="fw-bold">Fax</div>
                            
                            <div class="text-muted">(123) 123-456</div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 