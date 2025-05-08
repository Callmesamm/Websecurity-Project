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
        // تجاوز التحقق من البيانات، والسماح بالدخول دائماً
        // يمكنك هنا تسجيل دخول مستخدم وهمي أو أول مستخدم في الجدول
        \Auth::loginUsingId(1); // تسجيل دخول المستخدم صاحب id=1 دائماً
        return redirect()->intended('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
