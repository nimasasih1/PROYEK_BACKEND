@php
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use Illuminate\Support\Facades\Auth;

$mahasiswa = null;
$hasCatatan = false;
$terdaftar = false;

if (Auth::check()) {
$user = Auth::user();
$mahasiswa = Mahasiswa::where('nim', $user->username)->first();

if ($mahasiswa) {
$pendaftaran = PendaftaranWisuda::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
->latest()
->first();

if ($pendaftaran) {
$terdaftar = true;
}

if (
$pendaftaran &&
(
$pendaftaran->catatan_fakultas ||
$pendaftaran->catatan_perpus ||
$pendaftaran->catatan_baak ||
$pendaftaran->catatan_finance
)
) {
$hasCatatan = true;
}
}
}
@endphp

@include('base.header')


<head>
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

        /* ========================================
           NAVBAR STYLES
           ======================================== */

        .navbar-top {
            box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
            background: #fff;
        }

        .navbar-brand-logo {
            display: flex;
            align-items: center;
            gap: 8px;
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

        .nav-link {
            color: #566a7f !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover {
            color: #980517 !important;
        }

        .nav-link i {
            margin-right: 0.5rem;
            font-size: 1.125rem;
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


        .card {
            border-radius: 1rem;
            overflow: hidden;
            border: none;
        }

        .card-header {
            background-color: #980517;
            color: #fff;
            font-weight: 600;
            font-size: 1.2rem;
            text-align: center;
        }

        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border-color: #980517;
            box-shadow: 0 0 5px rgba(152, 5, 23, 0.3);
        }

        .btn-primary {
            background-color: #980517;
            border-color: #980517;
            border-radius: 0.5rem;
        }

        .btn-primary:hover {
            background-color: #7a0412;
            border-color: #7a0412;
        }

        .btn-success {
            background-color: #198754;
            border-radius: 0.5rem;
        }

        .btn-success:hover {
            background-color: #146c43;
        }

        .progress {
            height: 10px;
            border-radius: 0.5rem;
            margin-bottom: 20px;
        }

        .progress-bar {
            background-color: #980517;
        }

        .fade-step {
            transition: opacity 0.5s ease, transform 0.5s ease;
            opacity: 0;
            transform: translateY(20px);
            display: none;
        }

        .fade-step.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        #canvasTTD {
            border: 1px solid #ccc;
            border-radius: 0.5rem;
        }

        /* Footer */
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

        .form-label {
            font-weight: 500;
            color: #566a7f;
            margin-bottom: 0.5rem;
        }

        .required-field::after {
            content: " *";
            color: red;
        }

        /* ============================ */
        /* RESPONSIVE FIX */
        /* ============================ */
        @media (max-width: 768px) {

            /* Supaya container ga terlalu sempit */
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            /* Semua form column turun */
            .col-md-6,
            .col-md-4,
            .col-md-7 {
                width: 100% !important;
            }

            /* Table tanda tangan auto full width */
            table {
                width: 100% !important;
                margin-top: 10px !important;
            }

            /* Kolom tanda tangan stacked */
            table tr td {
                display: block;
                width: 100% !important;
                text-align: center !important;
                padding-left: 0 !important;
            }

            /* TTD text biar lebih kecil */
            table tr td div {
                margin: 0 auto !important;
                text-align: center !important;
                font-size: 11px !important;
            }

            /* Hilangin padding kiri yang ekstrem */
            td[style*="padding-left"] {
                padding-left: 0 !important;
            }

            /* Card padding biar lega */
            .card-body {
                padding: 1.2rem !important;
            }

            /* Header form */
            .card-header {
                font-size: 1rem !important;
                padding: 10px !important;
            }

            /* Footer biar selalu center */
            footer {
                text-align: center !important;
                font-size: 10px !important;
                padding: 10px 5px !important;
            }

            /* Form label lebih kecil */
            .form-label {
                font-size: 14px !important;
            }

            /* Input tidak terlalu mepet */
            .form-control {
                font-size: 14px !important;
            }

            /* Progress bar lebih tipis */
            .progress {
                height: 8px !important;
            }
        }

        .fade-step {
            display: none;
        }

        .fade-step.show {
            display: block;
        }

        .required-field::after {
            content: " *";
            color: red;
        }

        /* Style untuk print */
        @media print {

            .progress,
            .btn,
            .card-header {
                display: none !important;
            }

            .signature-section {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header">Formulir Permohonan Wisuda</div>
                    <div class="card-body">

                        <!-- Progress Bar -->
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar" role="progressbar" style="width:50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        @if($terdaftar)
                        <div class="bg-green-50 border border-green-300 rounded-lg p-4 mb-4">
                            <div class="flex items-start gap-3">
                                <div class="text-green-600 text-xl">
                                    🎓
                                </div>
                                <div>
                                    <h4 class="font-semibold text-green-800 mb-1">
                                        Pendaftaran Wisuda Sudah Terkirim
                                    </h4>

                                    <p class="text-sm text-green-700">
                                        Data pendaftaran wisuda Anda telah berhasil dikirim.
                                        Silakan menunggu proses verifikasi dari pihak terkait.
                                    </p>

                                    <p class="text-xs text-gray-600 mt-2">
                                        Tanggal pendaftaran:
                                        <strong>
                                            {{ \Carbon\Carbon::parse($latest->created_at)->format('d/m/y') }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else

                        <form id="formPendaftaran" action="{{ route('daftar_wisuda.store') }}" method="POST">
                            @csrf

                            <!-- STEP 1 -->
                            <div id="step1" class="fade-step show">
                                <h6 class="text-dark mb-3">Mohon lengkapi data yang diminta</h6>

                                <!-- Tanggal Pendaftaran -->
                                <div class="mb-3">
                                    <label for="tgl_pendaftaran" class="form-label required-field">Tanggal Pendaftaran</label>
                                    <input type="date" id="tgl_pendaftaran" name="tgl_pendaftaran" class="form-control" required>
                                    <small class="text-muted">Tanggal hari ini Anda mendaftar</small>
                                </div>

                                <!-- Tanggal Perkiraan Wisuda -->
                                <div class="mb-3">
                                    <label for="tgl_perkiraan_wisuda" class="form-label required-field">Tanggal Perkiraan Wisuda</label>
                                    <input type="date" id="tgl_perkiraan_wisuda" name="tgl_perkiraan_wisuda" class="form-control" required>
                                    <small class="text-muted">Perkiraan tanggal pelaksanaan wisuda</small>
                                </div>

                                <h6 class="mb-3" style="border-bottom: 3px solid #DCC26A; padding-bottom: 6px; text-align:center;">Informasi Mahasiswa</h6>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">NIM</label>
                                        <input type="text" id="nim" name="nim" class="form-control"
                                            value="{{ $user->username }}" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" class="form-control"
                                            value="{{ $mahasiswa->nama_mahasiswa ?? '' }}" readonly>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Fakultas</label>
                                        <input type="text" id="fakultas" name="fakultas" class="form-control"
                                            value="{{ $mahasiswa->fakultas ?? '' }}" readonly>
                                    </div>

                                    <div class="col-md-4 mb-3 d-flex flex-column justify-content-end">
                                        <label>Jenjang</label>
                                        <select name="jenjang" class="form-select" required>
                                            <option value="">Pilih Jenjang</option>
                                            @foreach(['Diploma','Sarjana','Magister','Doktor'] as $j)
                                            <option value="{{ $j }}" {{ ($mahasiswa->jenjang ?? '')==$j ? 'selected':'' }}>{{ $j }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Jurusan</label>
                                        <input type="text" id="prodi" name="prodi" class="form-control"
                                            value="{{ $mahasiswa->prodi ?? '' }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="no_hp" class="form-label required-field">No. HP</label>
                                    <input type="tel" id="no_hp" name="no_hp" class="form-control"
                                        placeholder="Contoh: 081234567890"
                                        pattern="[0-9]{10,13}"
                                        required>
                                    <small class="text-muted">Format: 10-13 digit angka</small>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label required-field">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="contoh@email.com"
                                        value="{{ $user->email ?? '' }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label required-field">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control"
                                        placeholder="Masukkan alamat lengkap"
                                        value="{{ $mahasiswa->alamat ?? '' }}"
                                        required>
                                </div>

                                <h6 class="mb-3" style="border-bottom: 3px solid #DCC26A; padding-bottom: 6px; text-align:center;">Beban Studi Terakhir</h6>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="judul_skripsi" class="form-label required-field">Judul Skripsi/Tugas Akhir</label>
                                        <textarea id="judul_skripsi" name="judul_skripsi" class="form-control"
                                            rows="3"
                                            placeholder="Masukkan judul lengkap skripsi/tugas akhir Anda"
                                            required></textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="ipk" class="form-label required-field">IPK (Final Grade)</label>
                                        <input type="number" id="ipk" name="ipk" class="form-control"
                                            step="0.01"
                                            min="0"
                                            max="4.00"
                                            placeholder="Contoh: 3.75"
                                            required>
                                        <small class="text-muted">Masukkan IPK dengan format 2 desimal (0.00 - 4.00)</small>
                                    </div>
                                </div>

                                <!-- SECTION TTD UNTUK PRINT -->
                                <div class="signature-section mt-5 pt-4" style="border-top: 2px solid #DCC26A;">
                                    <h6 class="text-center mb-4">Tanda Tangan (Akan ditandatangani saat print)</h6>

                                    <!-- TTD Dosen Pembimbing 
                                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px; text-align:center;">
                                        <tr>
                                            <td style="height: 150px; vertical-align: top; padding-top: 20px;">
                                                <strong>TTD Dosen Pembimbing</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <div style="border-top:1px solid #000; width: 200px; margin: 0 auto; padding-top: 5px; font-size: 12px;">
                                                    Tanggal: __________________
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                    <p style="font-size: 10px; color: #888; text-align: center; margin: 20px 0;">
                                        Hanya mahasiswa yang telah memenuhi seluruh persyaratan akademik dan non-akademik program studinya hingga akhir semester yang diperbolehkan untuk mengikuti proses kelulusan.
                                    </p>

                                    TTD Mahasiswa 
                                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px; text-align:center;">
                                        <tr>
                                            <td style="height: 150px; vertical-align: top; padding-top: 20px;">
                                                <strong>TTD Mahasiswa</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <div style="border-top:1px solid #000; width: 200px; margin: 0 auto; padding-top: 5px; font-size: 12px;">
                                                    Tanggal: __________________
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                    TTD Kepala Program Studi 
                                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px; text-align:center;">
                                        <tr>
                                            <td style="height: 150px; vertical-align: top; padding-top: 20px;">
                                                <strong>TTD Kepala Program Studi</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <div style="border-top:1px solid #000; width: 200px; margin: 0 auto; padding-top: 5px; font-size: 12px;">
                                                    Tanggal: __________________
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                    TTD Dekan 
                                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px; text-align:center;">
                                        <tr>
                                            <td style="height: 150px; vertical-align: top; padding-top: 20px;">
                                                <strong>TTD Dekan</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <div style="border-top:1px solid #000; width: 200px; margin: 0 auto; padding-top: 5px; font-size: 12px;">
                                                    Tanggal: __________________
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                     Privacy Notice 
                                    <div style="margin-top: 40px; padding: 15px; background-color: #f8f9fa; border-radius: 5px;">
                                        <p style="font-size: 10px; color: #666; text-align: justify; margin: 0;">
                                            <strong>Pemberitahuan Privasi:</strong> Data pribadi yang diperoleh dari subjek data atau individu akan dimasukkan dan disimpan dalam sistem informasi dan komunikasi yang diotorisasi oleh perusahaan (sekolah), sesuai dengan jangka waktu yang diizinkan berdasarkan peraturan perundang-undangan yang berlaku, dan hanya dapat diakses oleh personel yang berwenang. (Sekolah) telah menerapkan langkah-langkah pengamanan yang tepat secara organisasi, teknis, dan fisik untuk melindungi data pribadi yang dikumpulkan. Selain itu, informasi yang dikumpulkan dapat dibagikan kepada dan tersedia bagi CHED dan/atau pihak terkait lainnya guna mendukung tujuan yang sah, kepentingan yang sah, serta memenuhi kewajiban hukum. Data ini hanya akan digunakan untuk keperluan operasional dan tidak akan diungkapkan kepada pihak lain tanpa persetujuan terlebih dahulu.
                                        </p>
                                    </div>

                                     Final Signature 
                                    <table style="width: 100%; border-collapse: collapse; margin-top: 40px; text-align:center;">
                                        <tr>
                                            <td style="height: 150px; vertical-align: top; padding-top: 20px;">
                                                <strong>Tanda Tangan di atas Nama Jelas</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <div style="border-top:1px solid #000; width: 200px; margin: 0 auto; padding-top: 5px; font-size: 12px;">
                                                    Nama: _________________________
                                                </div>
                                            </td>
                                        </tr>
                                    </table> -->
                                </div>

                                <div class="mt-4">
                                    <button type="button" class="btn btn-primary float-end" onclick="nextStep()">Next</button>
                                </div>
                            </div>

                            <!-- STEP 2 -->
                            <div id="step2" class="fade-step">
                                <h6 class="text-dark mb-3">Pengambilan Toga</h6>

                                <div class="mb-3">
                                    <label class="form-label required-field">Ukuran Toga</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ukuran" id="ukuranAllSize" value="All Size" required>
                                        <label class="form-check-label" for="ukuranAllSize">All Size</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Catatan Tambahan</label>
                                    <textarea name="catatan" class="form-control" rows="3" placeholder="Masukkan catatan jika ada (opsional)"></textarea>
                                </div>

                                <div class="d-flex gap-2 justify-content-end mt-3 flex-wrap">


                                    @if($latest)
                                    <div class="text-center mt-3">
                                        <a href="{{ route('pendaftaran.print', $latest->id_pendaftaran) }}"
                                            class="btn btn-danger px-4">
                                            Print PDF
                                        </a>
                                    </div>
                                    @endif



                                    <button type="button" class="btn btn-primary btn-sm" onclick="prevStep()">
                                        <i class="bi bi-arrow-left"></i> Back
                                    </button>
                                    <a href="{{ route('beranda') }}" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-house-door"></i> Beranda
                                    </a>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-check-circle"></i> Submit
                                    </button>
                                </div>
                            </div>

                        </form>
                        @endif

                        @if ($errors->any())
                        <div class="mt-3" style="color:red;">
                            @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let currentStep = 1;

    function nextStep() {
        // Validasi form step 1 sebelum pindah
        const step1Inputs = document.querySelectorAll('#step1 [required]');
        let isValid = true;

        step1Inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            alert('Mohon lengkapi semua field yang wajib diisi!');
            return;
        }

        // Pindah ke step 2
        document.getElementById('step1').classList.remove('show');
        document.getElementById('step2').classList.add('show');
        currentStep = 2;
        updateProgressBar();

        // Scroll ke atas saat pindah step
        window.scrollTo(0, 0);
    }

    function prevStep() {
        // Kembali ke step 1
        document.getElementById('step2').classList.remove('show');
        document.getElementById('step1').classList.add('show');
        currentStep = 1;
        updateProgressBar();

        // Scroll ke atas saat pindah step
        window.scrollTo(0, 0);
    }

    function updateProgressBar() {
        const progressBar = document.getElementById('progressBar');
        if (currentStep === 1) {
            progressBar.style.width = '50%';
            progressBar.setAttribute('aria-valuenow', '50');
        } else if (currentStep === 2) {
            progressBar.style.width = '100%';
            progressBar.setAttribute('aria-valuenow', '100');
        }
    }

    // Set default tanggal pendaftaran ke hari ini
    document.addEventListener('DOMContentLoaded', function() {
        currentStep = 1;
        updateProgressBar();

        // Auto-fill tanggal pendaftaran dengan hari ini
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tgl_pendaftaran').value = today;
    });
</script>
<script>
    let terdaftar = @json($terdaftar);

    function fadeOut(element, callback) {
        element.classList.remove('show');
        setTimeout(callback, 500);
    }

    function fadeIn(element) {
        element.classList.add('show');
    }

    function updateProgress(step) {
        const bar = document.getElementById('progressBar');
        bar.style.width = step === 1 ? '50%' : '100%';
    }

    function nextStep() {
        // Validasi form step 1
        const form = document.getElementById('formPendaftaran');
        const step1Inputs = document.querySelectorAll('#step1 input[required], #step1 textarea[required], #step1 select[required]');

        let isValid = true;
        step1Inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            alert('Mohon lengkapi semua field yang wajib diisi (bertanda *)');
            return;
        }

        // Validasi IPK
        const ipk = document.getElementById('ipk').value;
        if (ipk < 0 || ipk > 4) {
            alert('IPK harus antara 0.00 sampai 4.00');
            return;
        }

        // Validasi No HP
        const noHp = document.getElementById('no_hp').value;
        if (noHp.length < 10 || noHp.length > 13) {
            alert('Nomor HP harus 10-13 digit');
            return;
        }

        // FIX: Cek terdaftar - karena $terdaftar itu boolean, bukan array
        if (terdaftar === true) {
            alert("Anda sudah terdaftar untuk wisuda, tidak bisa lanjut!");
            return;
        }

        let step1 = document.getElementById('step1');
        let step2 = document.getElementById('step2');

        fadeOut(step1, () => {
            fadeIn(step2);
            updateProgress(2);
        });
    }

    function prevStep() {
        let step1 = document.getElementById('step1');
        let step2 = document.getElementById('step2');

        fadeOut(step2, () => {
            fadeIn(step1);
            updateProgress(1);
        });
    }

    // Validasi real-time untuk IPK
    document.addEventListener('DOMContentLoaded', function() {
        const ipkInput = document.getElementById('ipk');
        if (ipkInput) {
            ipkInput.addEventListener('input', function() {
                if (this.value > 4) {
                    this.value = 4.00;
                }
                if (this.value < 0) {
                    this.value = 0;
                }
            });
        }
    });
</script>

@if(session('success_swal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Pendaftaran Berhasil 🎓',
            html: `
                <p style="margin-bottom:6px;">
                    Terima kasih, <strong>pendaftaran wisuda Anda telah berhasil disimpan</strong>.
                </p>
                <p style="font-size:14px;color:#666;">
                    Silakan menunggu proses verifikasi dari pihak terkait.
                </p>
            `,
            confirmButtonText: 'OK, Mengerti',
            confirmButtonColor: '#980517',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = 'http://folder_baru_new.test/beranda#';
        });
    });
</script>
@endif