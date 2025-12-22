@php
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use Illuminate\Support\Facades\Auth;
use App\Models\Skpi;

$mahasiswa = null;
$skpi = null;
$hasCatatan = false;

if (Auth::check()) {
$user = Auth::user();

// ambil data mahasiswa
$mahasiswa = Mahasiswa::where('nim', $user->username)->first();

if ($mahasiswa) {

// ambil data SKPI
$skpi = Skpi::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
->latest()
->first();

// ambil data pendaftaran wisuda
$pendaftaran = PendaftaranWisuda::whereHas('mahasiswa', function ($q) use ($mahasiswa) {
$q->where('nim', $mahasiswa->nim);
})->latest()->first();

if ($pendaftaran &&
($pendaftaran->catatan_fakultas ||
$pendaftaran->catatan_perpus ||
$pendaftaran->catatan_baak ||
$pendaftaran->catatan_finance)) {
$hasCatatan = true;
}
}
}
@endphp

@include('base.header')


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Raleway', sans-serif;
        overflow-x: hidden;
        background-color: #f8f9fa;
    }

    .navbar-top {
        box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
        background: #fff;
    }

    .navbar-brand-logo {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-link {
        color: #566a7f !important;
        font-weight: 500;
        padding: 0.5rem 1rem !important;
    }

    .nav-link:hover {
        color: #980517 !important;
    }

    .dropdown-menu {
        border: 1px solid rgba(67, 89, 113, 0.1);
        box-shadow: 0 0.25rem 1rem rgba(161, 172, 184, 0.45);
    }

    .dropdown-item {
        padding: 0.5rem 1.5rem;
    }

    .dropdown-item:hover {
        background-color: rgba(105, 108, 255, 0.08);
        color: #980517;
    }

    body {
        min-height: 100vh;
        background-image: url('skpi/public/skpi/images/bg.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(193, 193, 193, 0.3);
        z-index: -1;
    }

    .card-form {
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 25px;
        max-width: 650px;
        margin: 50px auto;
        background: #ffffff;
        /* ← GANTI INI SAJA */
    }


    .card-header-custom {
        background-color: #980517;
        color: #fff;
        font-weight: 600;
        font-size: 1.1rem;
        text-align: center;
        border-radius: 12px;
        margin-bottom: 15px;
        padding: 10px 0;
    }

    h4 {
        font-size: 0.95rem;
        font-weight: 600;
        color: #980517;
        margin-bottom: 8px;
    }

    label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #333;
        margin-bottom: 5px;
    }

    .form-control,
    textarea.form-control {
        font-size: 0.85rem;
        padding: 8px 12px;
    }

    .text-muted {
        font-size: 0.75rem;
    }

    .alert {
        font-size: 0.85rem;
    }

    canvas {
        border-radius: 6px;
        border: 1px solid #980517;
        width: 100%;
        height: 120px;
    }

    .btn-primary,
    .btn-success,
    .btn-secondary {
        border-radius: 0.5rem;
    }

    .btn-primary {
        background-color: #980517;
        border-color: #980517;
    }

    .btn-primary:hover {
        background-color: #6c0c11;
        border-color: #6c0c11;
    }

    .btn-success {
        background-color: #198754;
    }

    .content-footer {
        background: #f8f9fa;
        border-top: 1px solid #e7e9ed;
        padding: 1.5rem 0;
        margin-top: 3rem;
    }

    .footer-link {
        color: #566a7f;
        text-decoration: none;
        transition: color 0.2s;
    }

    .footer-link:hover {
        color: #980517;
    }

    .btn-success:hover {
        background-color: #146c43;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<body>
    <!-- FORM SKPI -->
    <div class="card-form shadow-sm">
        <div class="card-header-custom">Form Pengajuan SKPI</div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($skpi)
        <div class="bg-green-50 border border-green-300 rounded-lg p-4 mb-4">
            <div class="flex items-start gap-3">
                <div class="text-green-600 text-xl">
                    ✔
                </div>
                <div>
                    <h4 class="font-semibold text-green-800 mb-1">
                        Pengajuan SKPI Sudah Terkirim
                    </h4>

                    <p class="text-sm text-green-700">
                        Data SKPI Anda telah berhasil dikirim.
                        Tidak diperlukan proses verifikasi lanjutan dari mahasiswa.
                    </p>

                    <p class="text-xs text-gray-600 mt-2">
                        Tanggal pengajuan:
                        <strong>
                            {{ \Carbon\Carbon::parse($skpi->tgl_pengajuan_mahasiswa)->format('d M Y') }}
                        </strong>
                    </p>

                    @if($skpi->file_skpi)
                    <a href="{{ asset('uploads/skpi/'.$skpi->file_skpi) }}"
                        target="_blank"
                        class="inline-block mt-3 text-sm text-blue-600 underline">
                        Lihat File SKPI
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if(!$skpi)
        <form action="{{ route('skpi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ID mahasiswa (hidden untuk proses penyimpanan) -->
            <input type="hidden" name="tgl_pengajuan_mahasiswa" value="{{ date('Y-m-d') }}">
            <input type="hidden" name="id_mahasiswa" value="{{ $mahasiswa->id_mahasiswa }}">

            <!-- ===================== -->
            <!--  BAGIAN DATA MAHASISWA -->
            <!-- =====================

            <h4 class="mb-3">Data Mahasiswa</h4>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Nama Mahasiswa</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->nama_mahasiswa }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>NIM</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->nim }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Fakultas</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->fakultas }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Program Studi</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->prodi }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tahun Masuk / Tahun</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->tahun }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jenjang</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->jenjang }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>No Telepon</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->no_telp }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->email }}" readonly>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="3" readonly>{{ $mahasiswa->alamat }}</textarea>
                </div>

            </div>-->

            <!-- ===================== -->
            <!--  SECTION 01: IDENTITAS PEMEGANG SKPI -->
            <!-- ===================== -->
            <h4 class="mb-3 mt-4">01. INFORMASI TENTANG IDENTITAS DIRI PEMEGANG SKPI</h4>
            <p class="text-muted small">01. INFORMATION IDENTIFYING THE HOLDER OF THE DIPLOMA SUPPLEMENT</p>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Nama Lengkap / Full Name</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ $mahasiswa->nama_mahasiswa }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tempat Lahir / Place of Birth</label>
                    <input type="text"
                        class="form-control"
                        value="{{ $mahasiswa->tempat_lahir }}"
                        readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tanggal Lahir / Date of Birth</label>
                    <input type="date"
                        class="form-control"
                        value="{{ $mahasiswa->tanggal_lahir }}"
                        readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nomor Induk Mahasiswa / Student Identification Number</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->nim }}" readonly>
                </div>
            </div>
            <!-- ===================== -->
            <!--  SECTION 03: CAPAIAN PEMBELAJARAN -->
            <!-- ===================== -->
            <h4 class="mb-3 mt-4">02. INFORMASI TENTANG CAPAIAN PEMBELAJARAN</h4>
            <p class="text-muted small">02. INFORMATION ON LEARNING OUTCOMES</p>

            <div class="row">

                <div class="col-md-12 mb-3">
                    <label>Aktivitas, Prestasi dan Penghargaan / Activities, Achievement and Awards</label>
                    <textarea name="aktiv_pres_penghargaan" class="form-control" rows="4" placeholder="Isi dengan aktivitas, prestasi, dan penghargaan yang diperoleh..."></textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Magang / Internship</label>
                    <textarea name="magang" class="form-control" rows="4" placeholder="Isi dengan pengalaman magang/internship..."></textarea>
                </div>

            </div>

            <!-- ===================== -->
            <!--  UPLOAD FILE -->
            <!-- ===================== -->
            <div class="mb-3 mt-4">
                <label class="form-label">Upload Berkas PDF SKPI</label>
                <input type="file"
                    name="file_pdf"
                    class="form-control"
                    accept="application/pdf"
                    required>
                <small class="text-muted">Format: PDF • Maks ukuran 2MB</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Kirim
                </button>
            </div>
        </form>
        @endif

    </div>

    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-3 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                © <script>
                    document.write(new Date().getFullYear());
                </script> Horizon University | All Rights Reserved
            </div>
            <div>
                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>