<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;

class MemberAuthController extends Controller
{
    public function form() {
        return view('auth.member_login');
    }

    public function showRegisterForm() {
        return view('auth.member_register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|confirmed|min:6',
        ]);

        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('member.form')->with('success', 'Pendaftaran berhasil!');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('member')->attempt($credentials)) {
            return redirect('/home');
        }

        return back()->withErrors(['email' => 'Login gagal.']);
    }

    public function logout(Request $request) {
        Auth::guard('member')->logout();
        return redirect('/');
    }
}
