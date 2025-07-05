<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->is_admin !== 1) {
            return redirect('/admin/login');
        }

        return $next($request); // ⬅️ Tambahkan ini agar middleware lanjut ke halaman berikutnya
    }
}
