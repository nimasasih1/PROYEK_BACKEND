<form id="formPendaftaran" action="{{ route('daftar_wisuda.store') }}" method="POST">
    @csrf

    <!-- STEP 1: PENDAFTARAN WISUDA -->
    <div id="step1">
        <h4>Form Pendaftaran Wisuda</h4>

        <div class="mb-3">
            <label>NIM</label>
            <input type="text" id="nim" name="nim" class="form-control" value="{{ $user->username }}" readonly>
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" class="form-control" value="{{ $mahasiswa->nama_mahasiswa ?? '' }}" readonly>
        </div>

        <div class="mb-3">
            <label>Fakultas</label>
            <input type="text" id="fakultas" name="fakultas" class="form-control" value="{{ $mahasiswa->fakultas ?? '' }}" readonly>
        </div>

        <div class="mb-3">
            <label>Program Studi</label>
            <input type="text" id="prodi" name="prodi" class="form-control" value="{{ $mahasiswa->prodi ?? '' }}" readonly>
        </div>

        <div class="mb-3">
            <label>Tahun Angkatan</label>
            <input type="text" id="tahun" name="tahun" class="form-control" value="{{ $mahasiswa->tahun ?? '' }}" readonly>
        </div>

        <div class="mb-3">
            <label for="tgl_pendaftaran">Tanggal Pendaftaran</label>
            <input type="date" name="tgl_pendaftaran" class="form-control" required>
        </div>

        <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
    </div>

    <!-- STEP 2: PENGAMBILAN TOGA -->
    <div id="step2" style="display: none;">
        <h4>Form Pengambilan Toga</h4>

        <div class="form-check">
        <input class="form-check-input" type="radio" name="ukuran" id="ukuranS" value="S" required>
        <label class="form-check-label" for="ukuranS">Reguler</label>
    </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Tanda Tangan</label><br>
            <canvas id="canvasTTD" style="border:1px solid #000; width:300px; height:150px;"></canvas>
            <input type="hidden" name="ttd" id="ttdInput">
            <button type="button" class="btn btn-secondary mt-2" onclick="clearCanvas()">Hapus</button>
        </div>

        <button type="button" class="btn btn-secondary" onclick="prevStep()">Back</button>
        <button type="submit" class="btn btn-success">Selesai</button>
    </div>
</form>

<script>
    // --- Data mahasiswa yang sudah terdaftar dari backend
    let terdaftar = @json($terdaftar);

    function nextStep() {
        // Cek apakah mahasiswa sudah terdaftar
        let nim = document.getElementById('nim').value;
        if (terdaftar.includes(nim)) {
            alert("Anda sudah terdaftar untuk wisuda, tidak bisa lanjut!");
            return;
        }

        // Lanjut ke step 2
        document.getElementById('step1').style.display = "none";
        document.getElementById('step2').style.display = "block";
    }

    function prevStep() {
        document.getElementById('step2').style.display = "none";
        document.getElementById('step1').style.display = "block";
    }

    // --- Canvas TTD ---
    let canvas = document.getElementById('canvasTTD');
    let ctx = canvas.getContext('2d');
    let drawing = false;

    canvas.addEventListener('mousedown', () => drawing = true);
    canvas.addEventListener('mouseup', () => {
        drawing = false;
        document.getElementById('ttdInput').value = canvas.toDataURL();
    });
    canvas.addEventListener('mousemove', draw);

    function draw(e) {
        if (!drawing) return;
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.strokeStyle = "#000";
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(e.offsetX, e.offsetY);
    }

    function clearCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        document.getElementById('ttdInput').value = "";
    }
</script>

@if ($errors->any())
    <div style="color:red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
