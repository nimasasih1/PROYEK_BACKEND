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
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header">Form Pendaftaran Wisuda</div>
                    <div class="card-body">

                        <!-- Progress Bar -->
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar" role="progressbar" style="width:50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <form id="formPendaftaran" action="{{ route('daftar_wisuda.store') }}" method="POST">
                            @csrf

                            <!-- STEP 1 -->
                            <div id="step1" class="fade-step show">
                                <h6 class="text-dark mb-3">Data Mahasiswa</h6>
                                <div class="mb-3">
                                    <label>NIM</label>
                                    <input type="text" id="nim" name="nim" class="form-control"
                                        value="{{ $user->username }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Nama</label>
                                    <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" class="form-control"
                                        value="{{ $mahasiswa->nama_mahasiswa ?? '' }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Fakultas</label>
                                    <input type="text" id="fakultas" name="fakultas" class="form-control"
                                        value="{{ $mahasiswa->fakultas ?? '' }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Program Studi</label>
                                    <input type="text" id="prodi" name="prodi" class="form-control"
                                        value="{{ $mahasiswa->prodi ?? '' }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Tahun Angkatan</label>
                                    <input type="text" id="tahun" name="tahun" class="form-control"
                                        value="{{ $mahasiswa->tahun ?? '' }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_pendaftaran">Tanggal Pendaftaran</label>
                                    <input type="date" name="tgl_pendaftaran" class="form-control" required>
                                </div>
                                <button type="button" class="btn btn-primary float-end" onclick="nextStep()">Next</button>
                            </div>

                            <!-- STEP 2 -->
                           <div id="step2" class="fade-step">
    <h6 class="text-dark mb-3">Pengambilan Toga</h6>

    <!-- Tambah pilihan ukuran lengkap -->
    <label class="form-label">Ukuran Toga</label>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="ukuran" id="ukuranS" value="S" required>
        <label class="form-check-label" for="ukuranS">S</label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="ukuran" id="ukuranM" value="M">
        <label class="form-check-label" for="ukuranM">M</label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="ukuran" id="ukuranL" value="L">
        <label class="form-check-label" for="ukuranL">L</label>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="radio" name="ukuran" id="ukuranXL" value="XL">
        <label class="form-check-label" for="ukuranXL">XL</label>
    </div>

    <div class="mb-3">
        <label>Catatan</label>
        <textarea name="catatan" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label>Tanda Tangan</label>
        <canvas id="canvasTTD" style="width:100%; height:150px;"></canvas>
        <input type="hidden" name="ttd" id="ttdInput">
        <button type="button" class="btn btn-secondary mt-2" onclick="clearCanvas()">Hapus</button>
    </div>

    <div class="d-flex gap-2 justify-content-end mt-3 flex-wrap">
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
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            MyWebsite | All Rights Reserved
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
        let nim = document.getElementById('nim').value;
        if (terdaftar.includes(nim)) {
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

   // Canvas TTD
let canvas = document.getElementById('canvasTTD');
let ctx = canvas.getContext('2d');
let drawing = false;

canvas.addEventListener('mousedown', startDraw);
canvas.addEventListener('mouseup', endDraw);
canvas.addEventListener('mousemove', draw);

function getPos(e) {
    const rect = canvas.getBoundingClientRect();
    return {
        x: (e.clientX - rect.left) * (canvas.width / rect.width),
        y: (e.clientY - rect.top) * (canvas.height / rect.height)
    };
}

function startDraw(e) {
    drawing = true;
    const pos = getPos(e);
    ctx.beginPath();
    ctx.moveTo(pos.x, pos.y);
}

function endDraw() {
    drawing = false;
    document.getElementById('ttdInput').value = canvas.toDataURL();
    ctx.beginPath();
}

function draw(e) {
    if (!drawing) return;
    const pos = getPos(e);

    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.strokeStyle = '#980517';

    ctx.lineTo(pos.x, pos.y);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(pos.x, pos.y);
}

function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    document.getElementById('ttdInput').value = '';
}

</script>