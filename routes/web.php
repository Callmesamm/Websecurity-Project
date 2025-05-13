<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Public routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

// Password reset routes
Route::get('/forgot-password', [App\Http\Controllers\Auth\PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\Auth\PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Auth\PasswordResetController::class, 'reset'])->name('password.update');

// Email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home')->with('success', 'Email verified successfully!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});