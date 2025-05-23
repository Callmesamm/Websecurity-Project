<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/home')->with('success', 'You are already logged in!');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $this->redirectBasedOnRole($user);
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }

    /**
     * Redirect users based on their role
     */
    protected function redirectBasedOnRole($user)
    {
        // Check if user has admin role
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome to the admin dashboard!');
        }

        // Check if user has manager role
        if ($user->hasRole('manager')) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome to the manager dashboard!');
        }

        // Default redirect for other users
        return redirect('/home')->with('success', 'Login successful!');
    }
}