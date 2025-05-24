<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists by email
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if (!$user) {
                // Create a new user
                $user = User::create([
                    'first_name' => $googleUser->user['given_name'] ?? $googleUser->getName(),
                    'last_name' => $googleUser->user['family_name'] ?? '',
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)), // Random password for OAuth users
                    'email_verified_at' => now(), // Mark email as verified
                    'google_id' => $googleUser->getId(),
                ]);
                
                // Assign default role (assuming 2 is the ID for the 'user' role)
                $user->roles()->attach(2);
            } else {
                // Update google_id if logging in with Google for the first time
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
            }
            
            // Create or update social account
            SocialAccount::updateOrCreate(
                [
                    'provider' => 'google',
                    'provider_id' => $googleUser->getId(),
                ],
                [
                    'user_id' => $user->id,
                    'token' => $googleUser->token,
                    'refresh_token' => $googleUser->refreshToken,
                    'expires_at' => now()->addSeconds($googleUser->expiresIn),
                ]
            );
            
            // Log the user in
            Auth::login($user, true);
            
            return redirect()->intended('/home');
            
        } catch (\Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Unable to login with Google. Please try again.');
        }
    }
}