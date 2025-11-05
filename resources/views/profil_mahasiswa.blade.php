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

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


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

    body {
        font-family: 'Raleway', sans-serif;
        min-height: 100vh;
        /* Background gambar full */
        background-image: url('images/bg.png');
        /* ganti dengan path gambarmu */
        background-size: cover;
        /* biar menutupi seluruh halaman */
        background-position: center;
        /* posisi di tengah */
        background-repeat: no-repeat;
        background-attachment: fixed;
        /* biar tetap saat scroll */
    }

    .profile-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        border: 2px solid #ffe6e6;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        max-width: 400px;
        width: 100%;
        padding-top: 15px;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        /* tingkat kegelapan */
        z-index: -1;
    }

    .navbar-top {
        box-shadow: 0 2px 6px rgba(67, 89, 113, 0.12);
        background: #fff;
    }

    .nav-link {
        color: #566a7f !important;
        font-weight: 500;
    }

    .nav-link:hover {
        color: #980517 !important;
    }

    .profile-container {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
        max-width: 1200px;
        width: 100%;
        margin: 50px auto;
    }


    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 4px solid #000000ff;
    }

    .profile-actions a {
        margin-left: 15px;
        font-size: 20px;
        color: #000000ff;
        transition: color 0.3s;
    }

    .profile-actions a:hover {
        color: #000000ff;
    }

    .btn-home {
        position: absolute;
        top: 20px;
        left: 25px;
        font-size: 20px;
        color: #980517;
        text-decoration: none;
    }

    .btn-home:hover {
        color: #7a0412;
    }

    h4.fw-bold {
        margin-bottom: 0;
    }

    p.username {
        color: #555;
        margin-bottom: 20px;
    }

    .profile-info p {
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .profile-info strong {
        color: #000000ff;
    }

    .card-notes {
        flex: 1 1 350px;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background: #fff;
        transition: transform 0.3s ease;
    }

    .card-notes .card-header {
        background-color: #980517;
        color: #fff;
        font-weight: 600;
        text-align: center;
        font-size: 1rem;
        border-radius: 15px 15px 0 0;
        padding: 10px 0;
        margin-bottom: 15px;
    }

    .card-notes .card-body p {
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .card-notes:hover {
        transform: translateY(-3px);
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
<style>
    .profile-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 30px;
        margin: 50px auto;
    }

    .card-notes table tr th {
        font-weight: 600;
        text-align: left;
        padding: 12px;
    }

    .card-notes table tr td {
        padding: 12px;
    }

    .card-notes {
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-notes:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    .profile-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .profile-actions a,
    .profile-actions button {
        margin-left: 15px;
        font-size: 20px;
        color: #980517;
        transition: color 0.3s;
    }

    .profile-actions a:hover,
    .profile-actions button:hover {
        color: #000000ff;
    }

    .profile-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    #logoutBtn:hover,
    .profile-actions a:hover {
        color: #000000ff;
    }
</style>
</head>

<body>

    <!-- PROFIL MAHASISWA -->
    <div class="profile-container flex-column align-items-center">
        <!-- Profil Card -->
        <div class="profile-card mb-4" style="
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    border-radius: 25px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    border: 2px solid #ffe6e6;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    max-width: 400px;
    width: 100%;
    padding-top: 15px;
">
            <!-- Edit di kanan atas -->
            <div style="position:absolute; top:15px; right:15px;">
                <a href="{{ route('edit_profil.edit') }}" title="Edit Profil" style="font-size:20px; color:#980517;">
                    <i class="fas fa-pen"></i>
                </a>
            </div>

            <!-- Avatar -->
            <div style="position: relative; margin: 60px auto 15px auto; text-align:center;">
                <img src="{{ $mahasiswa && $mahasiswa->avatar ? asset($mahasiswa->avatar) : asset('assets/img/avatars/1.png') }}"
                    alt="Avatar" class="profile-avatar" style="
                width: 130px;
                height: 130px;
                border-radius: 50%;
                object-fit: cover;
                border: 4px solid #980517;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                margin-bottom: 10px;
            ">
                <!-- Small glow effect -->
                <div style="
            position: absolute;
            top: -5px;
            left: calc(50% - 70px);
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(152,5,23,0.15);
            z-index: -1;
        "></div>
            </div>

            <!-- Nama & Username -->
            <h4 class="fw-bold text-center" style="font-size: 1.6rem; color: #980517;">{{ $mahasiswa->nama_mahasiswa ?? 'Nama belum diisi' }}</h4>
            <p class="username text-center" style="color: #555; font-weight: 500; margin-bottom: 20px;">{{ $user->username }}</p>
            <hr style="border-top: 1px solid #ffe6e6; margin: 15px 0;">

            <!-- Info Profil -->
            <div class="profile-info text-start px-3" style="font-size: 0.95rem; color: #444;">
                <p><strong style="color:#980517;">Fakultas:</strong> {{ $mahasiswa->fakultas ?? '-' }}</p>
                <p><strong style="color:#980517;">Program Studi:</strong> {{ $mahasiswa->prodi ?? '-' }}</p>
                <p><strong style="color:#980517;">Angkatan:</strong> {{ $mahasiswa->tahun ?? '-' }}</p>
            </div>
        </div>

        <!-- Catatan Card (di bawah profil) -->
        <div class="card-notes w-100" style="max-width: 700px; background: linear-gradient(to bottom right, #fff0f2, #ffe6e6);">
            <div class="card-header">Catatan Fakultas & Unit Terkait</div>
            <div class="card-body p-0">
                @if($pendaftaran)
                <table class="table mb-0 table-striped">
                    <tbody>
                        <tr>
                            <th style="width: 40%; background-color:#980517; color:#fff;">Fakultas</th>
                            <td>{{ $pendaftaran->catatan_fakultas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 40%; background-color:#980517; color:#fff;">Perpustakaan</th>
                            <td>{{ $pendaftaran->catatan_perpus ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 40%; background-color:#980517; color:#fff;">BAAK</th>
                            <td>{{ $pendaftaran->catatan_baak ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 40%; background-color:#980517; color:#fff;">Finance</th>
                            <td>{{ $pendaftaran->catatan_finance ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
                @else
                <p class="text-muted text-center p-3">Belum ada catatan dari pihak kampus.</p>
                @endif
            </div>
        </div>
    </div>
    <!-- FOOTER -->
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
        document.getElementById('logoutBtn').addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                document.getElementById('logoutForm').submit();
            }
        });
    </script>

</body>

</html>