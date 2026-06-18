<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the login page
     */
    public function showLogin()
    {
        return view('auth.login_nw');
    }

    /**
     * Handle login request
     */
    public function handleLogin(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate using username
        if (Auth::attempt(['username' => $validated['username'], 'password' => $validated['password']])) {
            // Authentication successful
            $request->session()->regenerate();
            
            $user = Auth::user();
            $role = strtolower($user->role);

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($role === 'kaprodi') {
                return redirect()->route('dashboard');
            }

            if ($role === 'dosen wali') {
                return redirect()->route('dosen-wali.dashboard');
            }
            
            return redirect()->route('dashboard');
        }

        // Authentication failed
        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password salah');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
