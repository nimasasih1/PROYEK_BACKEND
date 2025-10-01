<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Profil Mahasiswa</h2>

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

    <!-- Form Profil Mahasiswa -->
    <form action="{{ route('profil_mahasiswa.store') }}" method="POST">
        @csrf
        <!-- Hapus @method('PUT') karena mahasiswa login hanya POST -->

        <div class="mb-3">
            <label class="form-label">NIM (Username Login)</label>
            <input type="text" class="form-control" value="{{ $user->username }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa</label>
            <input type="text" name="nama_mahasiswa" class="form-control" value="{{ $mahasiswa->nama_mahasiswa ?? '' }}" required>
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
                @for($tahun = 2000; $tahun <= 2100; $tahun++)
                    <option value="{{ $tahun }}" {{ ($mahasiswa->tahun ?? '') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <a href="{{ url('/beranda') }}" class="btn btn-secondary ms-2">Kembali ke Beranda</a>

    <hr>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>

</body>
</html>

<script>
    const prodiOptions = {
        "FMB": [
            {value: "S1 Manajemen", text: "S1 Manajemen"},
            {value: "S1 Akuntansi", text: "S1 Akuntansi"}
        ],
        "FICT": [
            {value: "S1 Informatika", text: "S1 Informatika"},
            {value: "S1 Sistem Informasi", text: "S1 Sistem Informasi"},
            {value: "S1 Teknik Elektro", text: "S1 Teknik Elektro"}
        ],
        "FHS": [
            {value: "S1 Keperawatan", text: "S1 Keperawatan"},
            {value: "S1 Gizi", text: "S1 Gizi"}
        ]
    };

    function updateProdi() {
        const fakultas = document.getElementById('fakultas').value;
        const prodiSelect = document.getElementById('prodi');

        prodiSelect.innerHTML = '<option value="" disabled selected>Pilih Program Studi</option>';

        if(fakultasOptions = prodiOptions[fakultas]) {
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
        if(fakultas) {
            document.getElementById('fakultas').value = fakultas;
            updateProdi();
            if(prodi) {
                document.getElementById('prodi').value = prodi;
            }
        }
    });
</script>
