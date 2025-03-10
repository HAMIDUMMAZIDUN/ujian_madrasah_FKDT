<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard'); // Pastikan ada file user/dashboard.blade.php
    }
}

