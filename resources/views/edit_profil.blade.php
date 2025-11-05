@php
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use Illuminate\Support\Facades\Auth;

$hasCatatan = false;

if (Auth::check()) {
$user = Auth::user();
$mahasiswa = Mahasiswa::where('nim', $user->username)->first();

if ($mahasiswa) {
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

        /* =========================
           NAVBAR
        ========================== */
        .navbar-top {
            box-shadow: 0 2px 6px rgba(67, 89, 113, 0.12);
            background: #fff;
        }

        .nav-link {
            color: #566a7f !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover {
            color: #980517 !important;
        }

        /* =========================
           MAIN CONTENT
        ========================== */
        main {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 100px 20px 40px;
            min-height: calc(100vh - 180px);
            /* memberi ruang agar footer tidak menimpa */
        }

        .content-box {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 100%;
            max-width: 700px;
            margin-bottom: 30px;
            /* jarak antar konten dan footer */
        }

        .content-box h2 {
            text-align: center;
            color: #980517;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
            border: 1px solid #ccc;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #980517;
            box-shadow: 0 0 5px rgba(152, 5, 23, 0.3);
        }

        .btn-primary {
            background-color: #980517;
            border-color: #980517;
            border-radius: 0.5rem;
            padding: 8px 20px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #7a0412;
            border-color: #7a0412;
        }

        .btn-secondary {
            border-radius: 0.5rem;
        }

        /* =========================
           FOOTER (tidak fixed)
        ========================== */
        footer {
            background: #fff;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.08);
            border-radius: 15px;
            width: 90%;
            max-width: 700px;
            margin: 0 auto 40px auto;
            padding: 20px 0;
            text-align: center;
        }

        footer .footer-link {
            color: #566a7f;
            text-decoration: none;
            transition: color 0.2s;
        }

        footer .footer-link:hover {
            color: #980517;
        }
    </style>
</head>

<body>
    <main>
        <div class="content-box">
            <h2>Profil Mahasiswa</h2>

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

            <form action="{{ route('profil_mahasiswa.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">NIM (Username Login)</label>
                    <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="nama_mahasiswa" class="form-control"
                        value="{{ $mahasiswa->nama_mahasiswa ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fakultas</label>
                    <select name="fakultas" id="fakultas" class="form-select" required onchange="updateProdi()">
                        <option value="" disabled {{ empty($mahasiswa->fakultas) ? 'selected' : '' }}>Pilih Fakultas</option>
                        <option value="FMB" {{ ($mahasiswa->fakultas ?? '') == 'FMB' ? 'selected' : '' }}>Fakultas Manajemen dan Bisnis (FMB)</option>
                        <option value="FICT" {{ ($mahasiswa->fakultas ?? '') == 'FICT' ? 'selected' : '' }}>Fakultas Teknologi Informasi dan Komputer (FICT)</option>
                        <option value="FHS" {{ ($mahasiswa->fakultas ?? '') == 'FHS' ? 'selected' : '' }}>Fakultas Ilmu Kesehatan (FHS)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Program Studi</label>
                    <select name="prodi" id="prodi" class="form-select" required>
                        <option value="" disabled selected>Pilih Program Studi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Angkatan</label>
                    <select name="tahun" class="form-select" required>
                        <option value="" disabled {{ empty($mahasiswa->tahun) ? 'selected' : '' }}>Pilih Tahun</option>
                        @for($tahun = 2023; $tahun <= 2100; $tahun++)
                            <option value="{{ $tahun }}" {{ ($mahasiswa->tahun ?? '') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                            </option>
                            @endfor
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/profil-mahasiswa') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </main>

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
    <script>
        const prodiOptions = {
            "FMB": [{
                    value: "S1 Manajemen",
                    text: "S1 Manajemen"
                },
                {
                    value: "S1 Akuntansi",
                    text: "S1 Akuntansi"
                }
            ],
            "FICT": [{
                    value: "S1 Informatika",
                    text: "S1 Informatika"
                },
                {
                    value: "S1 Sistem Informasi",
                    text: "S1 Sistem Informasi"
                },
                {
                    value: "S1 Teknik Elektro",
                    text: "S1 Teknik Elektro"
                }
            ],
            "FHS": [{
                    value: "S1 Keperawatan",
                    text: "S1 Keperawatan"
                },
                {
                    value: "S1 Gizi",
                    text: "S1 Gizi"
                }
            ]
        };

        function updateProdi() {
            const fakultas = document.getElementById('fakultas').value;
            const prodiSelect = document.getElementById('prodi');
            prodiSelect.innerHTML = '<option value="" disabled selected>Pilih Program Studi</option>';

            const fakultasOptions = prodiOptions[fakultas];
            if (fakultasOptions) {
                fakultasOptions.forEach(p => {
                    let option = document.createElement('option');
                    option.value = p.value;
                    option.text = p.text;
                    prodiSelect.appendChild(option);
                });
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            const fakultas = "{{ $mahasiswa->fakultas ?? '' }}";
            const prodi = "{{ $mahasiswa->prodi ?? '' }}";
            if (fakultas) {
                document.getElementById('fakultas').value = fakultas;
                updateProdi();
                if (prodi) {
                    document.getElementById('prodi').value = prodi;
                }
            }
        });
    </script>
</body>