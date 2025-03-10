<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
        'role' => ['required', 'in:kabupaten,lembaga'], // Validasi role hanya bisa kabupaten atau lembaga
    ]);

    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Pastikan role yang dipilih sesuai dengan role di database
        if ($user->role !== $credentials['role']) {
            Auth::logout();
            return back()->withErrors(['email' => 'Role yang dipilih tidak sesuai dengan akun ini.']);
        }

        // Redirect berdasarkan role
        return ($user->role === 'kabupaten') 
            ? redirect()->route('dashboard') 
            : redirect()->route('dashboarduser');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
