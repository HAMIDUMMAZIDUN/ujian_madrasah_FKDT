<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
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
            $user = Auth::user();
            session(['user_id' => $user->id]); 
            Alert::success('Login Berhasil', 'Selamat datang, ' . $user->name . '!');

            if ($user->role === 'admin') {
                return redirect()->route('admin.layouts.dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.layouts.dashboard');
            }
        }

        Alert::error('Login Gagal', 'Email atau password salah!');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        Alert::info('Logout Berhasil', 'Anda telah keluar dari sistem.');
        return redirect()->route('login');
    }
}
