@php
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Penting untuk Storage::url()

$hasCatatan = false;

// Inisialisasi variabel untuk menghindari error "Undefined variable"
// Jika data mahasiswa ditemukan, $mahasiswa akan diisi; jika tidak, ia tetap Mahasiswa baru.
$mahasiswa = new Mahasiswa();
$user = Auth::user();

if ($user) {
// Cari data mahasiswa berdasarkan username (NIM) yang login
$mahasiswa = Mahasiswa::where('nim', $user->username)->first() ?? new Mahasiswa(['nim' => $user->username]);

// Logika pengecekan catatan wisuda (sudah ada)
if ($mahasiswa->exists) {
$pendaftaran = PendaftaranWisuda::whereHas('mahasiswa', function ($q) use ($mahasiswa) {
$q->where('nim', $mahasiswa->nim);
})->latest()->first();

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
} else {
// Jika tidak ada user login, kita biarkan $mahasiswa dan $user kosong
$user = (object)['username' => null];
}
// Tentukan URL foto saat ini untuk digunakan di HTML dan JS
$currentPhotoUrl = (isset($mahasiswa->foto_profil) && $mahasiswa->foto_profil)
? Storage::url($mahasiswa->foto_profil)
: 'https://via.placeholder.com/150?text=No+Photo';

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
                    <div class="card-header">Profil Mahasiswa</div>
                    <div class="card-body">
                        {{-- Notifikasi Error Validasi Laravel --}}
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        {{-- START: AREA TAMPILAN FOTO DAN PRATINJAU (SEBELUM FORM) --}}
                        <div class="text-center mb-4">
                            <img src="{{ $currentPhotoUrl }}"
                                alt="Foto Profil"
                                id="photoPreviewArea" {{-- <<< ID Krusial untuk JS --}}
                                class="img-thumbnail rounded-circle"
                                style="width: 150px; height: 150px; object-fit: cover;">
                            <p class="mt-2 text-muted">Foto Profil Saat Ini</p>
                        </div>
                        {{-- END: AREA TAMPILAN FOTO DAN PRATINJAU --}}


                        {{-- PERBAIKAN KRUSIAL: Tambahkan enctype="multipart/form-data" --}}
                        <form action="{{ route('profil_mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- FIELD UNGGAH FOTO --}}
                            <div class="mb-3">
                                <label for="foto_profil">Unggah Foto Profil Baru</label>
                                <input
                                    type="file"
                                    id="foto_profil"
                                    name="foto_profil"
                                    class="form-control @error('foto_profil') is-invalid @enderror"
                                    accept="image/jpeg, image/png, image/jpg"
                                    onchange="previewImage(event)">
                                <div class="form-text text-muted">Maksimal 2MB (JPG/JPEG/PNG)</div>

                                @error('foto_profil')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- FIELD LAINNYA --}}
                            <div class="mb-3">
                                <label>NIM (Username Login)</label>
                                <input type="text" class="form-control" value="{{ $user->username ?? '' }}" readonly>
                                <input type="hidden" name="nim" value="{{ $user->username ?? '' }}">
                            </div>

                            <div class="mb-3">
                                <label>Nama Mahasiswa</label>
                                <input type="text" name="nama_mahasiswa" class="form-control"
                                    value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Jenjang</label>
                                <select name="jenjang" class="form-select" required>
                                    <option value="" disabled selected>Pilih Jenjang</option>
                                    <option value="D3" {{ old('jenjang', $mahasiswa->jenjang) == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('jenjang', $mahasiswa->jenjang) == 'S1' ? 'selected' : '' }}>S1</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Fakultas</label>
                                <select name="fakultas" id="fakultas" class="form-select" required onchange="updateProdi()">
                                    <option value="" disabled {{ empty(old('fakultas', $mahasiswa->fakultas)) ? 'selected' : '' }}>Pilih Fakultas</option>
                                    <option value="FMB" {{ old('fakultas', $mahasiswa->fakultas) == 'FMB' ? 'selected' : '' }}>Fakultas Manajemen dan Bisnis</option>
                                    <option value="FICT" {{ old('fakultas', $mahasiswa->fakultas) == 'FICT' ? 'selected' : '' }}>Fakultas Teknologi Informasi dan Komputer</option>
                                    <option value="FHS" {{ old('fakultas', $mahasiswa->fakultas) == 'FHS' ? 'selected' : '' }}>Fakultas Ilmu Kesehatan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Program Studi</label>
                                <select name="prodi" id="prodi" class="form-select" required>
                                    <option value="" disabled selected>Pilih Program Studi</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Tahun Angkatan</label>
                                <select name="tahun" class="form-select" required>
                                    <option value="" disabled selected>Pilih Tahun</option>
                                    @for($tahun = 2023; $tahun <= 2100; $tahun++)
                                        <option value="{{ $tahun }}" {{ old('tahun', $mahasiswa->tahun) == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                        </option>
                                        @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>No. Telp</label>
                                <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $mahasiswa->no_telp) }}">
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ old('email', $mahasiswa->email) }}"
                                    pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                                    title="Email harus berakhiran @gmail.com" required>
                            </div>

                            <div class="mb-3">
                                <label>Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control"
                                    value="{{ old('alamat', $mahasiswa->alamat) }}">
                            </div>

                            <div class="mb-3">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control"
                                    value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir) }}">
                            </div>

                            <div class="mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir) }}">
                            </div>


                            <div class="d-flex justify-content-between">
                                <a href="{{ url('/profil-mahasiswa') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
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
    {{-- CDN SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Variabel PHP yang di-pass ke JS
        const defaultPhotoUrl = @json($currentPhotoUrl);

        // Program Studi Dinamis
        const prodiOptions = {
            "FMB": ["S1 Manajemen", "S1 Akuntansi"],
            "FICT": ["S1 Informatika", "S1 Sistem Informasi", "S1 Teknik Elektro"],
            "FHS": ["S1 Keperawatan", "S1 Gizi"]
        };

        function updateProdi() {
            const fakultas = document.getElementById('fakultas').value;
            const prodiSelect = document.getElementById('prodi');
            prodiSelect.innerHTML = '<option value="" disabled selected>Pilih Program Studi</option>';

            const oldProdi = @json(old('prodi', $mahasiswa->prodi ?? ''));

            (prodiOptions[fakultas] || []).forEach(p => {
                let option = document.createElement('option');
                option.value = p;
                option.text = p;

                // Set selected jika cocok dengan nilai lama/tersimpan
                if (p === oldProdi) {
                    option.selected = true;
                }
                prodiSelect.appendChild(option);
            });
        }

        // Set default prodi saat halaman dimuat
        window.addEventListener('DOMContentLoaded', () => {
            // Gunakan old() untuk mengisi ulang jika ada error validasi
            const fakultas = "{{ old('fakultas', $mahasiswa->fakultas ?? '') }}";

            if (fakultas) {
                document.getElementById('fakultas').value = fakultas;
                updateProdi();
            }
        });


        /**
         * FUNGSI UNTUK PRATINJAU FOTO
         */
        function previewImage(event) {
            // Mencari ID elemen <img>
            const imageElement = document.getElementById('photoPreviewArea');

            // Mencari ID elemen <input type="file">
            const fileInput = document.getElementById('foto_profil');

            const file = event.target.files[0];

            if (!imageElement) {
                console.error("Kesalahan: Elemen pratinjau dengan ID 'photoPreviewArea' tidak ditemukan.");
                return;
            }

            if (file) {
                if (file.type.match('image.*')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imageElement.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    // Jika file bukan gambar, reset input dan tampilkan alert
                    imageElement.src = 'https://via.placeholder.com/150?text=File+Invalid';
                    fileInput.value = '';
                    alert('File yang dipilih bukan format gambar yang didukung (JPG, PNG, JPEG).');
                }
            } else {
                // Jika input dikosongkan/dibatalkan, kembali ke foto lama
                imageElement.src = defaultPhotoUrl;
            }
        }

        // SweetAlert for Success Message
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Disimpan!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#980517'
        });
        @endif
    </script>
</body>