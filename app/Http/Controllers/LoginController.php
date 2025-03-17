<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user(); // Mendapatkan data user yang berhasil login

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Admin masuk ke dashboard utama
            } elseif ($user->role === 'user') {
                return redirect()->route('Lembaga.dashboard'); // User masuk ke user dashboard
            }
        }

        return redirect()->back()->with('error', 'Tes error SweetAlert!');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
