<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function googlePage()
    {

        return Socialite::driver('google')->redirect();
    }
    public function googleCallBack()
    {

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user already exists
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // If user doesn't exist, create a new one
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('default_password'), // Or set as null
                ]);
            }

            // Log the user in
            Auth::login($user);

            return redirect()->intended('/'); // Redirect to a protected route
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Unable to login using Google.']);
        }
    }
}
