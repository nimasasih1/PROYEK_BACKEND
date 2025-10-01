<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pengajuan SKPI</title>
</head>
<body>
<div class="container mt-4">
    <h3>Form Pengajuan SKPI</h3>

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

    <form action="{{ route('skpi.store') }}" method="POST">
        @csrf

        <!-- Data Mahasiswa (otomatis) -->
        <div class="mb-3">
            <label>NIM</label>
            <input type="text" class="form-control" value="{{ $mahasiswa->nim ?? '' }}" readonly>
        </div>

        <div class="mb-3">
            <label>Nama Mahasiswa</label>
            <input type="text" class="form-control" value="{{ $mahasiswa->nama_mahasiswa ?? '' }}" readonly>
        </div>

        <div class="mb-3">
            <label>Fakultas</label>
            <input type="text" class="form-control" value="{{ $mahasiswa->fakultas ?? '' }}" readonly>
        </div>

        <div class="mb-3">
            <label>Program Studi</label>
            <input type="text" class="form-control" value="{{ $mahasiswa->prodi ?? '' }}" readonly>
        </div>

        <!-- Input Mahasiswa -->
        <div class="mb-3">
            <label>Tanggal Pengajuan</label>
            <input type="date" name="tgl_pengajuan_mahasiswa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenjang</label>
            <input type="text" name="jenjang_mahasiswa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No. HP</label>
            <input type="text" name="no_hp_mahasiswa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email_mahasiswa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat_mahasiswa" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
    <label>Tanda Tangan</label>
    <canvas id="signature-pad" width="400" height="150" style="border:1px solid #000;"></canvas>
    <button type="button" id="clear-signature" class="btn btn-warning btn-sm mt-2">Clear</button>
    <input type="hidden" name="ttd_mahasiswa" id="ttd_mahasiswa">
</div>
        <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
    </form>

    <a href="{{ url('/beranda') }}" class="btn btn-secondary ms-2">Kembali ke Beranda</a>
</div>
</body>
</html>

<script>
const canvas = document.getElementById('signature-pad');
const ctx = canvas.getContext('2d');
let drawing = false;

// Event untuk menggambar
canvas.addEventListener('mousedown', () => drawing = true);
canvas.addEventListener('mouseup', () => drawing = false);
canvas.addEventListener('mousemove', draw);

function draw(e) {
    if (!drawing) return;
    const rect = canvas.getBoundingClientRect();
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.strokeStyle = '#000';
    ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
}

// Tombol clear
document.getElementById('clear-signature').addEventListener('click', () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
});

// Sebelum submit form, simpan canvas ke hidden input
document.querySelector('form').addEventListener('submit', function(e){
    const dataURL = canvas.toDataURL();
    document.getElementById('ttd_mahasiswa').value = dataURL;
});
</script>