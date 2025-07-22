<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect based on user role
            $user = Auth::user();
            
            if ($user->hasAnyRole(['admin', 'gym_manager', 'gym_instructor'])) {
                return redirect()->intended('/admin');
            }

            return redirect()->intended(route('dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records. Visit the Test Credentials page for available accounts.'],
        ]);
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'You have been logged out successfully.');
    }
}
