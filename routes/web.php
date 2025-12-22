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
use App\Http\Controllers\SyaratKetentuanControllers;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\UserImportController;
use App\Http\Controllers\MahasiswaImportController;
use App\Http\Controllers\SkpiImportController;
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
Route::middleware(['auth'])->group(function () {

    Route::get('/beranda', function () {
        return view('beranda');
    })->name('beranda');

    Route::get('/syarat-ketentuan', function () {
    $hasCatatan = false; // Tambahkan ini!
    return view('syarat-ketentuan', compact('hasCatatan'));
})->name('syarat-ketentuan');

    Route::get('/profil-mahasiswa', [MahasiswaController::class, 'show'])->name('profil_mahasiswa.show');
    Route::post('/profil-mahasiswa', [MahasiswaController::class, 'store'])->name('profil_mahasiswa.store');
    Route::get('/edit-profil', [MahasiswaController::class, 'editProfilUser'])->name('edit_profil.edit');
    Route::post('/edit-profil', [MahasiswaController::class, 'store'])->name('edit_profil.store');

    Route::get('/wisuda/print/{id}', [DaftarWisudaController::class, 'print']);

    Route::get('/daftar_wisuda', [DaftarWisudaController::class, 'index'])->name('daftar_wisuda.index');
    Route::get('/daftar_wisuda/create', [DaftarWisudaController::class, 'create'])->name('daftar_wisuda.create');
    Route::post('/daftar_wisuda', [DaftarWisudaController::class, 'store'])->name('daftar_wisuda.store');

    Route::get('/skpi/print/{id}', [SkpiController::class, 'print'])->name('skpi.print');
    Route::get('/skpi/create', [SkpiController::class, 'create'])->name('skpi.create');
    Route::post('/skpi/store', [SkpiController::class, 'store'])->name('skpi.store');
    Route::get('/skpi/finish', function () {
        return view('skpi.finish');
    })->name('skpi.finish');

    Route::get('/profil', fn() => view('profil'))->name('profil');
    Route::get('/layanan', fn() => view('layanan'))->name('layanan');
    Route::get('/kontak', fn() => view('kontak'))->name('kontak');

    Route::post('/kesan/store', [MahasiswaController::class, 'storeKesan'])->name('kesan.store');

    
});


// ===================== BAAK (layouts) =====================
Route::middleware(['auth'])->group(function () {

    Route::get('/layouts', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::put('/dashboard/update/{id}', [DashboardController::class, 'updateStatus'])->name('dashboard.update');

    Route::get('/viewmahasiswa', [MahasiswaController::class, 'index'])->name('viewmahasiswa.profil_mahasiswa.index');
    Route::put('/viewmahasiswa/profil/{nim}', [MahasiswaController::class, 'update'])->name('profil.update');
    Route::delete('/viewmahasiswa/profil/{nim}', [MahasiswaController::class, 'destroy'])->name('profil.destroy');

    Route::get('/viewmahasiswa/daftar-wisuda1', [DaftarWisudaController::class, 'listWisuda'])->name('viewmahasiswa.daftar_wisuda1.wisuda1');
    Route::post('/viewmahasiswa/daftar-wisuda1/store', [DaftarWisudaController::class, 'store'])->name('viewmahasiswa.daftar_wisuda1.store');
    Route::put('/viewmahasiswa/wisuda1/{id}', [DaftarWisudaController::class, 'update'])->name('viewmahasiswa.wisuda1.update');
    Route::delete('/viewmahasiswa/wisuda1/{id}', [DaftarWisudaController::class, 'destroy'])->name('wisuda1.destroy');
    Route::get('/viewmahasiswa/wisuda1/print/{id}', [WisudaController::class, 'print'])->name('wisuda1.print');

    Route::get('/viewmahasiswa/pending', [DaftarWisudaController::class, 'pending'])->name('viewmahasiswa.pending');
    Route::put('/viewmahasiswa/pending/{id}', [DaftarWisudaController::class, 'updateStatus'])->name('viewmahasiswa.pending.update');

    Route::get('/viewmahasiswa/selesai', [DaftarWisudaController::class, 'selesai'])->name('viewmahasiswa.selesai');
    Route::get('/viewmahasiswa/togaselesai', [DaftarWisudaController::class, 'selesaiToga'])
        ->name('viewmahasiswa.togaselesai')
        ->middleware('auth');

    Route::get('/viewmahasiswa/skpi', [SkpiController::class, 'listSkpi'])->name('viewmahasiswa.skpi');
    Route::post('/viewmahasiswa/skpi/store', [SkpiController::class, 'store'])->name('viewmahasiswa.skpi.store');
    Route::put('/viewmahasiswa/skpi/{id}', [SkpiController::class, 'update'])->name('skpi.update');
    Route::delete('/viewmahasiswa/skpi/{id}', [SkpiController::class, 'destroy'])->name('skpi.destroy');

    Route::get('/dashboard', [InformasiController::class, 'index'])->name('dashboard.index1');
    Route::post('/dashboard/store', [InformasiController::class, 'store'])->name('dashboard.store');
    Route::put('/dashboard/update/{id}', [InformasiController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/{id}', [InformasiController::class, 'destroy'])->name('dashboard.destroy');

    Route::get('/dashboard/index1', [InformasiController::class, 'index'])->name('dashboard.index1');

    Route::get('/dashboard/qna', [InformasiController::class, 'qnaIndex'])->name('dashboard.qna');
    Route::post('/dashboard/qna/store', [InformasiController::class, 'qnaStore'])->name('qna.store');
    Route::get('/dashboard/qna/{id}', [InformasiController::class, 'qnaShow'])->name('qna.show');
    Route::put('/dashboard/qna/{id}', [InformasiController::class, 'qnaUpdate'])->name('qna.update');
    Route::delete('/dashboard/qna/{id}', [InformasiController::class, 'qnaDestroy'])->name('qna.delete');

    Route::get('/dashboard/syarat', [SyaratKetentuanControllers::class, 'syaratIndex'])->name('dashboard.syarat');
    Route::post('/dashboard/syarat/store', [SyaratKetentuanControllers::class, 'syaratStore'])->name('syarat.store');
    Route::get('/dashboard/syarat/{id}', [SyaratKetentuanControllers::class, 'syaratShow'])->name('syarat.show');
    Route::put('/dashboard/syarat/{id}', [SyaratKetentuanControllers::class, 'syaratUpdate'])->name('syarat.update');
    Route::delete('/dashboard/syarat/{id}', [SyaratKetentuanControllers::class, 'syaratDestroy'])->name('syarat.destroy');

    Route::get('/dashboard/kesan-mahasiswa', [MahasiswaController::class, 'indexKesan'])->name('dashboard.kesan');
    Route::post('/dashboard/kesan-mahasiswa/store', [MahasiswaController::class, 'storeKesan'])->name('kesan.store');
    Route::get('/dashboard/kesan-mahasiswa/{id}/edit', [MahasiswaController::class, 'editKesan'])->name('kesan.edit');
    Route::put('/dashboard/kesan-mahasiswa/{id}', [MahasiswaController::class, 'updateKesan'])->name('kesan.update');
    Route::delete('/dashboard/kesan-mahasiswa/{id}', [MahasiswaController::class, 'destroyKesan'])->name('kesan.destroy');
    Route::patch('/dashboard/kesan-mahasiswa/{id}/toggle', [MahasiswaController::class, 'toggleStatusKesan'])->name('kesan.toggle');

    Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])->name('dashboard.admin');
    Route::post('/dashboard/admin/foto', [DashboardController::class, 'updateFoto'])->name('admin.updateFoto');
    Route::post('/admin/update-password', [DashboardController::class, 'updatePassword'])->name('admin.updatePassword');

    Route::post('/wisuda1/update-status-list/{id}', [DaftarWisudaController::class, 'updateStatusList']);
    Route::get('/users/template', [UserImportController::class, 'download'])->name('users.template');
    Route::get('/mahasiswa/template', [MahasiswaImportController::class, 'download'])->name('mahasiswa.template');


    Route::get('/toga-selesai', function () {
        return view('viewmahasiswa.togaselesai');
    })->name('toga.selesai');

    // Untuk debugging status list
    Route::get('/debug/toga/{id}', function ($id) {
        $toga = \App\Models\Toga::find($id);
        if (!$toga) {
            $toga = \App\Models\Toga::where('id_pendaftaran', $id)->first();
        }

        return response()->json([
            'exists' => !!$toga,
            'toga' => $toga,
            'id_requested' => $id
        ]);
    });
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
Route::delete('/wisuda1/{id}', [WisudaController::class, 'destroy'])
    ->name('wisuda1.delete');

Route::post('/users/import', [UserImportController::class, 'import'])->name('users.import');
Route::get('/users/export', [UserImportController::class, 'exportUsers'])->name('users.export');
Route::post('/mahasiswa/import', [MahasiswaImportController::class, 'import'])->name('mahasiswa.import');
Route::get('/users/template', [UserImportController::class, 'download'])->name('users.template');
Route::get('/mahasiswa/template', [MahasiswaImportController::class, 'download'])->name('mahasiswa.template');
Route::get('/skpi/template', [SkpiImportController::class, 'download'])->name('skpi.template');
Route::post('/skpi/import', [SkpiImportController::class, 'import'])->name('skpi.import');
Route::get('/skpi/export', [SkpiImportController::class, 'exportUsers'])->name('skpi.export');
