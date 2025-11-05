<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SkpiController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaftarWisudaController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\WisudaController;
use App\Http\Middleware\RoleMiddleware;

// Halaman login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Halaman register
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'submit'])->name('register.submit');


// ===================== MAHASISWA =====================
Route::middleware(['auth' ])->group(function () {

    Route::get('/beranda', function () {
        return view('beranda');
    })->name('beranda');

    Route::get('/profil-mahasiswa', [MahasiswaController::class, 'show'])->name('profil_mahasiswa.show');
    Route::post('/profil-mahasiswa', [MahasiswaController::class, 'store'])->name('profil_mahasiswa.store');
    Route::get('/edit-profil', [MahasiswaController::class, 'editProfilUser'])->name('edit_profil.edit');
    Route::post('/edit-profil', [MahasiswaController::class, 'store'])->name('edit_profil.store');

    Route::get('/daftar_wisuda', [DaftarWisudaController::class, 'index'])->name('daftar_wisuda.index');
    Route::get('/daftar_wisuda/create', [DaftarWisudaController::class, 'create'])->name('daftar_wisuda.create');
    Route::post('/daftar_wisuda', [DaftarWisudaController::class, 'store'])->name('daftar_wisuda.store');

    Route::get('/skpi/create', [SkpiController::class, 'create'])->name('skpi.create');
    Route::post('/skpi/store', [SkpiController::class, 'store'])->name('skpi.store');

    Route::get('/profil', fn() => view('profil'))->name('profil');
    Route::get('/layanan', fn() => view('layanan'))->name('layanan');
    Route::get('/kontak', fn() => view('kontak'))->name('kontak');
});


// ===================== BAAK (layouts) =====================
Route::middleware(['auth'])->group(function () {

    Route::get('/layouts', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::put('/dashboard/update-status/{id}', [DashboardController::class, 'updateStatus'])->name('dashboard.updateStatus');

    Route::get('/viewmahasiswa', [MahasiswaController::class, 'index'])->name('viewmahasiswa.profil_mahasiswa.index');
    Route::put('/viewmahasiswa/profil/{nim}', [MahasiswaController::class, 'update'])->name('profil.update');
    Route::delete('/viewmahasiswa/profil/{nim}', [MahasiswaController::class, 'destroy'])->name('profil.destroy');

    Route::get('/viewmahasiswa/daftar-wisuda1', [DaftarWisudaController::class, 'listWisuda'])->name('viewmahasiswa.daftar_wisuda1.wisuda1');
    Route::post('/viewmahasiswa/daftar-wisuda1/store', [DaftarWisudaController::class, 'store'])->name('viewmahasiswa.daftar_wisuda1.store');
    Route::put('/viewmahasiswa/wisuda1/{id}', [DaftarWisudaController::class, 'update'])->name('viewmahasiswa.wisuda1.update');
    Route::delete('/viewmahasiswa/wisuda1/{id}', [DaftarWisudaController::class, 'destroy'])->name('wisuda1.destroy');

    Route::get('/viewmahasiswa/pending', [DaftarWisudaController::class, 'pending'])->name('viewmahasiswa.pending');
    Route::put('/viewmahasiswa/pending/{id}', [DaftarWisudaController::class, 'updateStatus'])->name('viewmahasiswa.pending.update');

    Route::get('/viewmahasiswa/selesai', [DaftarWisudaController::class, 'selesai'])->name('viewmahasiswa.selesai');

    Route::get('/viewmahasiswa/skpi', [SkpiController::class, 'listSkpi'])->name('viewmahasiswa.skpi');
    Route::post('/viewmahasiswa/skpi/store', [SkpiController::class, 'store'])->name('viewmahasiswa.skpi.store');
    Route::put('/viewmahasiswa/skpi/{id}', [SkpiController::class, 'update'])->name('skpi.update');
    Route::delete('/viewmahasiswa/skpi/{id}', [SkpiController::class, 'destroy'])->name('skpi.destroy');

    Route::get('/dashboard/create', [InformasiController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard/store', [InformasiController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/{id}/edit', [InformasiController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/{id}', [InformasiController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/{id}', [InformasiController::class, 'destroy'])->name('dashboard.destroy');

    Route::get('/dashboard/index1', [InformasiController::class, 'index'])->name('dashboard.index1');
});


// ===================== FINANCE =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/layouts2', [DashboardController::class, 'index2'])->name('dashboard.index2');
    Route::get('/layouts2/validation-finance', [DaftarWisudaController::class, 'listWisuda2'])->name('layouts2.validation_finance.index');
    Route::get('/layouts2/pending', [DaftarWisudaController::class, 'pending2'])->name('layouts2.pending');
    Route::put('/layouts2/validation-finance/{id}', [DaftarWisudaController::class, 'update'])->name('layouts2.validation_finance.update');
    Route::get('/beranda_finance', fn() => view('beranda_finance'))->name('beranda.finance');
});


// ===================== PERPUSTAKAAN =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/layouts3', [DashboardController::class, 'index3'])->name('dashboard.index3');
    Route::get('/layouts3/validation-perpus', [DaftarWisudaController::class, 'listWisuda3'])->name('layouts3.validation_perpus.index');
    Route::get('/layouts3/pending', [DaftarWisudaController::class, 'pending3'])->name('layouts3.pending');
    Route::put('/layouts3/validation-perpus/{id}', [DaftarWisudaController::class, 'update'])->name('layouts3.validation_perpus.update');
    Route::get('/beranda_perpustakaan', fn() => view('beranda_perpustakaan'))->name('beranda.perpustakaan');
});


// ===================== FAKULTAS =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/layouts4', [DashboardController::class, 'index4'])->name('dashboard.index4');
    Route::get('/layouts4/validation-faculty', [DaftarWisudaController::class, 'listWisuda4'])->name('layouts4.validation_faculty.index');
    Route::get('/layouts4/pending', [DaftarWisudaController::class, 'pending4'])->name('layouts4.pending');
    Route::put('/layouts4/validation-faculty/{id}', [DaftarWisudaController::class, 'update'])->name('layouts4.validation_faculty.update');
    Route::get('/beranda_fakultas', fn() => view('beranda_fakultas'))->name('beranda.fakultas');
});


// ===================== LUPA PASSWORD =====================
Route::get('password/request-otp', [ForgotPasswordController::class, 'requestOtpForm'])->name('password.request.otp');
Route::post('password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('password.send.otp');
Route::get('password/verify-otp', [ForgotPasswordController::class, 'verifyOtpForm'])->name('password.verify.otp');
Route::post('password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify.otp.submit');

Route::get('/forgot-password', fn() => view('auth.forgot_password'))->name('forgot.form');
Route::post('/forgot-password/request-otp', [ForgotPasswordController::class, 'requestOtp'])->name('forgot.requestOtp');
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot.resetPassword');



// Route untuk data wisuda
Route::get('/viewmahasiswa/wisuda1', [WisudaController::class, 'index'])->name('viewmahasiswa.wisuda1');
Route::put('/viewmahasiswa/wisuda1/{id}', [WisudaController::class, 'update'])->name('viewmahasiswa.wisuda1.update');
Route::delete('/wisuda1/{id}', [WisudaController::class, 'destroy'])->name('wisuda1.destroy');