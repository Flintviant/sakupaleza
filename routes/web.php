<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\MemberAuthController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/tentang', function () {
    return view('about');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    // atau misalnya:
    Route::resource('/berita', BeritaController::class);
});

Route::get('/galeri', [GaleriController::class, 'GaleriLanding'])->name('galeri.landing');

Route::get('/berita', [BeritaController::class, 'BeritaLanding'])->name('berita.landing');

Route::get('/kontak', [KontakController::class, 'KontakLanding'])->name('kontak.landing');
Route::middleware('auth:member')->group(function () {
    Route::get('/member/dashboard', function () {
        return view('member.dashboard');
    })->name('member.dashboard');
});

Route::get('/register', [MemberAuthController::class, 'showRegisterForm'])->name('member.register.form');
Route::post('/register', [MemberAuthController::class, 'register'])->name('member.register');
Route::get('/logindaftar', [MemberAuthController::class, 'form'])->name('member.form');
Route::post('/member/login', [MemberAuthController::class, 'login'])->name('member.login');
Route::post('/member/register', [MemberAuthController::class, 'register'])->name('member.register');
Route::get('/member/register', [MemberAuthController::class, 'showRegisterForm']);
Route::get('/login', function () {
    return redirect()->route('member.form');
})->name('login');


Route::post('/logout', function () {
    Auth::guard('member')->logout();
    return redirect('/');
})->name('logout');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth:member')->name('index');

Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

Route::middleware(['auth', 'adminauth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');
});
Route::middleware('auth:member')->group(function () {
    // Halaman daftar pesanan (riwayat)
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');

    // Halaman form pemesanan
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');

    // Simpan pemesanan
    // Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

    // Halaman pembayaran untuk 1 order tertentu
    Route::get('/order/{order}/payment', [OrderController::class, 'payment'])->name('order.payment');

    // Simpan preview pembayaran ke session
    Route::post('/order/payment/preview', [OrderController::class, 'previewPayment'])->name('order.payment.preview');

    // Tampilkan halaman pembayaran (dengan timer)
    Route::get('/order/payment', [OrderController::class, 'paymentPage'])->name('order.payment.page');

    // Simpan konfirmasi pembayaran (upload bukti + metode)
    Route::post('/order/payment/confirm', [OrderController::class, 'confirmPayment'])->name('order.payment.confirm');

    // Setelah pembayaran berhasil
    Route::get('/order/confirmed/{id}', [OrderController::class, 'confirmed'])->name('order.confirmed');

    // Dashboard member
    Route::get('/member/dashboard', [OrderController::class, 'history'])->name('member.dashboard');
});




Route::post('/get-kelurahan', [WilayahController::class, 'getKelurahan'])->name('get.kelurahan');

Route::post('/admin/logout', function () {
    Auth::logout(); // atau pakai guard jika dibedakan
    return redirect('/admin/login');
})->name('admin.logout');

Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
Route::get('/admin/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
Route::post('/admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
Route::get('/admin/berita/{id}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
Route::put('/admin/berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
Route::delete('/admin/berita/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');

Route::get('/admin/galeri', [GaleriController::class, 'index'])->name('admin.galeri.index');
Route::get('/admin/galeri/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
Route::post('/admin/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
Route::get('/admin/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('admin.galeri.edit');
Route::put('/admin/galeri/{id}', [GaleriController::class, 'update'])->name('admin.galeri.update');
Route::delete('/admin/galeri/{id}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');

Route::get('/admin/kontak', [KontakController::class, 'index'])->name('admin.kontak.index');
Route::get('/admin/kontak/create', [KontakController::class, 'create'])->name('admin.kontak.create');
Route::post('/admin/kontak', [KontakController::class, 'store'])->name('admin.kontak.store');
Route::get('/admin/kontak/{id}/edit', [KontakController::class, 'edit'])->name('admin.kontak.edit');
Route::put('/admin/kontak/{id}', [KontakController::class, 'update'])->name('admin.kontak.update');
Route::delete('/admin/kontak/{id}', [KontakController::class, 'destroy'])->name('admin.kontak.destroy');

// Route::get('/admin/order', [OrderController::class, 'index'])->name('admin.order.index');
Route::get('/admin/order/create', [OrderAdminController::class, 'create'])->name('admin.order.create');
Route::post('/admin/order', [OrderAdminController::class, 'store'])->name('admin.order.store');
Route::get('/admin/order/{id}', [OrderAdminController::class, 'show'])->name('admin.order.show');
Route::delete('/admin/order/{id}', [OrderAdminController::class, 'destroy'])->name('admin.order.destroy');

// Untuk member
Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');

// Untuk admin
Route::prefix('admin/menu')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\MenuController::class, 'index'])->name('admin.menu.index');
    Route::get('/create', [App\Http\Controllers\Admin\MenuController::class, 'create'])->name('admin.menu.create');
    Route::post('/', [App\Http\Controllers\Admin\MenuController::class, 'store'])->name('admin.menu.store');
    Route::get('/{menu}/edit', [App\Http\Controllers\Admin\MenuController::class, 'edit'])->name('admin.menu.edit');
    Route::put('/{menu}', [App\Http\Controllers\Admin\MenuController::class, 'update'])->name('admin.menu.update');
    Route::delete('/{menu}', [App\Http\Controllers\Admin\MenuController::class, 'destroy'])->name('admin.menu.destroy');
});
// Keranjang
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');

Route::middleware(['auth', 'adminauth'])->prefix('admin')->group(function () {
    // Pesanan Masuk
    Route::get('/orders', [OrderAdminController::class, 'index'])->name('admin.order.index');

    // History
Route::get('/admin/order/history', [OrderAdminController::class, 'history'])->name('admin.order.history');

    // Laporan Penjualan
    Route::get('/orders/report', [OrderAdminController::class, 'report'])->name('admin.order.report');

    // Ubah Status
    Route::post('/orders/{order}/update-status', [OrderAdminController::class, 'updateStatus'])->name('admin.order.updateStatus');

    // Lihat detail
    Route::get('/orders/{order}', [OrderAdminController::class, 'show'])->name('admin.order.show');
});
