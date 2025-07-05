<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            if (Auth::guard('web')->user()->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::guard('web')->logout();
                return redirect('/admin/login')->with('error', 'Akses ditolak.');
            }
        }

        return redirect('/admin/login')->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('success', 'Anda sudah logout.');
    }
}
