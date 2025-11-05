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
        background: rgba(0, 0, 0, 0.3);
        z-index: -1;
    }

    .card-form {
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 25px;
        max-width: 650px;
        margin: 50px auto;
        background: rgba(255, 255, 255, 0.95);
    }

    .card-header-custom {
        background-color: #980517;
        color: #fff;
        font-weight: 600;
        font-size: 1.2rem;
        text-align: center;
        border-radius: 12px;
        margin-bottom: 15px;
        padding: 10px 0;
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

        <form action="{{ route('skpi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Informasi Mahasiswa (readonly) -->
            <div class="mb-2">
                <label class="form-label">NIM</label>
                <input type="text" class="form-control form-control-sm" value="{{ $mahasiswa->nim ?? '' }}" readonly>
            </div>
            <div class="mb-2">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control form-control-sm" value="{{ $mahasiswa->nama_mahasiswa ?? '' }}" readonly>
            </div>
            <div class="mb-2">
                <label class="form-label">Fakultas</label>
                <input type="text" class="form-control form-control-sm" value="{{ $mahasiswa->fakultas ?? '' }}" readonly>
            </div>
            <div class="mb-2">
                <label class="form-label">Program Studi</label>
                <input type="text" class="form-control form-control-sm" value="{{ $mahasiswa->prodi ?? '' }}" readonly>
            </div>

            <!-- Input Mahasiswa -->
            <div class="mb-2">
                <label class="form-label">Tanggal Pengajuan</label>
                <input type="date" name="tgl_pengajuan_mahasiswa" class="form-control form-control-sm" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Jenjang</label>
                <input type="text" name="jenjang_mahasiswa" class="form-control form-control-sm" required>
            </div>
            <div class="mb-2">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp_mahasiswa" class="form-control form-control-sm" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" name="email_mahasiswa" class="form-control form-control-sm" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Alamat</label>
                <textarea name="alamat_mahasiswa" class="form-control form-control-sm" rows="2" required></textarea>
            </div>

            <!-- Tanda Tangan -->
            <div class="mb-2">
                <label class="form-label">Tanda Tangan</label>
                <canvas id="signature-pad" width="600" height="120" style="border:1px solid #980517; border-radius:6px;"></canvas>
                <div class="mt-1 d-flex gap-2">
                    <button type="button" id="clear-signature" class="btn btn-warning btn-sm">
                        <i class="bi bi-trash"></i> Clear
                    </button>
                    <button type="button" id="save-signature" class="btn btn-primary btn-sm">
                        <i class="bi bi-save"></i> Simpan TTD
                    </button>
                </div>
                <input type="hidden" name="ttd_mahasiswa" id="ttd_mahasiswa">
                <small id="ttd-status" class="text-success" style="display:none;">Tanda tangan tersimpan!</small>
            </div>

            <!-- Upload File SKPI -->
            <div class="mb-2">
                <label class="form-label">Upload File SKPI (PDF/JPG/PNG)</label>
                <input type="file" name="file_skpi" class="form-control form-control-sm" accept=".pdf,.jpg,.png" required>
            </div>

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-send"></i> Kirim</button>
                <a href="{{ url('/beranda') }}" class="btn btn-secondary btn-sm"><i class="bi bi-house-door"></i> Beranda</a>
            </div>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const canvas = document.getElementById('signature-pad');
            const ctx = canvas.getContext('2d');
            let drawing = false;

            // Gambar di canvas
            canvas.addEventListener('mousedown', () => drawing = true);
            canvas.addEventListener('mouseup', () => {
                drawing = false;
                ctx.beginPath();
            });
            canvas.addEventListener('mouseout', () => {
                drawing = false;
                ctx.beginPath();
            });
            canvas.addEventListener('mousemove', draw);

            function draw(e) {
                if (!drawing) return;
                const rect = canvas.getBoundingClientRect();
                ctx.lineWidth = 2;
                ctx.lineCap = 'round';
                ctx.strokeStyle = '#980517';
                ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
                ctx.stroke();
                ctx.beginPath();
                ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
            }

            // Tombol clear
            document.getElementById('clear-signature').addEventListener('click', () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                document.getElementById('ttd_mahasiswa').value = '';
                document.getElementById('ttd-status').style.display = 'none';
            });

            // Tombol simpan sementara
            document.getElementById('save-signature').addEventListener('click', () => {
                const dataURL = canvas.toDataURL('image/png');
                const blank = document.createElement('canvas');
                blank.width = canvas.width;
                blank.height = canvas.height;

                if (dataURL === blank.toDataURL()) {
                    alert('Silakan buat tanda tangan terlebih dahulu!');
                    return;
                }

                document.getElementById('ttd_mahasiswa').value = dataURL;
                document.getElementById('ttd-status').style.display = 'inline';
                console.log('Tanda tangan tersimpan sementara.');
            });
        </script>

    </div>
</body>

</html>