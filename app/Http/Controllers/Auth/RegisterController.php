<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use App\Models\Role;




class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // In RegisterController.php - modify the register method
public function register(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Assign customer role to new user
    $customerRole = Role::where('name', 'customer')->first();
    if ($customerRole) {
        $user->roles()->attach($customerRole->id);
    }

    try {
        event(new Registered($user)); // Trigger verification email
        $message = 'Registration successful! Please check your email to verify your account.';
    } catch (\Exception $e) {
        Log::error('Failed to send verification email: ' . $e->getMessage());
        $message = 'Registration successful, but we could not send the verification email. Please verify your email later.';
    }

    Auth::login($user);

    return redirect()->route('verification.notice')->with('success', $message);
}}