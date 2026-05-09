@php
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use Illuminate\Support\Facades\Auth;

$hasCatatan = false;
$mahasiswa = null;
$user = null;
$pendaftaran = null;

if (Auth::check()) {
$user = Auth::user();
// Gunakan find() jika 'username' sesuai dengan primary key, atau where().
$mahasiswa = Mahasiswa::where('nim', $user->username)->first();

if ($mahasiswa) {
$pendaftaran = PendaftaranWisuda::whereHas('mahasiswa', function ($q) use ($mahasiswa) {
$q->where('nim', $mahasiswa->nim);
})->latest()->first();
// Atau lebih cepat jika relasi sudah didefinisikan:
// $pendaftaran = $mahasiswa->pendaftaranWisuda()->latest()->first();


if ($pendaftaran &&
($pendaftaran->catatan_fakultas ||
$pendaftaran->catatan_perpus ||
$pendaftaran->catatan_baak ||
$pendaftaran->catatan_finance ||
$pendaftaran->catatan_csdl)) {
$hasCatatan = true;
}
}
}
@endphp

@include('base.header')

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

    <div class="container my-5">
        <div class="card"
            style="border-radius:25px; padding:35px; box-shadow:0 15px 35px rgba(0,0,0,0.15); background:white;">

            <div class="row g-4 align-items-start">

                <div class="col-md-5">
                    <div class="profile-card"
                        style="background:rgba(255,255,255,0.9); border-radius:25px; padding:25px;
                    box-shadow:0 10px 25px rgba(0,0,0,0.12); position:relative;">

                        <a href="{{ route('edit_profil.edit') }}" title="Edit Profile"
                            style="position:absolute; top:15px; right:15px; font-size:22px; color:#980517;">
                            <i class="fas fa-pen"></i>
                        </a>

                        <div class="text-center">

                            <div class="text-center mb-4">
                                @php
                                // Tentukan URL foto saat ini
                                $fotoUrl = isset($mahasiswa->foto_profil) && $mahasiswa->foto_profil
                                ? asset($mahasiswa->foto_profil) // langsung dari public
                                : 'https://via.placeholder.com/150?text=No+Photo';
                                @endphp
                                <img src="{{ $fotoUrl }}"
                                    alt="Profile Photo"
                                    class="img-thumbnail rounded-circle"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            </div>

                            <h3 class="fw-bold" style="color:#980517;">
                                {{ $mahasiswa?->nama_mahasiswa ?? '-' }}
                            </h3>

                            <p style="color:#333; font-weight:500;">
                                @if(isset($user) && $user->username)
                                {{ $user->username }}
                                @else
                                -
                                @endif
                            </p>
                        </div>

                        <hr>

                        <div style="font-size:0.95rem;">
                            <p><strong style="color:#980517;" title="Fakultas">Faculty:</strong> {{ $mahasiswa?->fakultas ?? '-' }}</p>
                            <p><strong style="color:#980517;" title="Program Studi">Study Program:</strong> {{ $mahasiswa?->prodi ?? '-' }}</p>
                            <p><strong style="color:#980517;" title="Angkatan">Batch Year:</strong> {{ $mahasiswa?->tahun ?? '-' }}</p>
                        </div>


                        <div class="card" style="border-radius: 12px; margin-top: 10px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="background:#980517; color:white; cursor:pointer;"
                                data-bs-toggle="collapse" data-bs-target="#formKesan">
                                <h6 class="mb-0" title="Tambah Kesan">Add Testimonial</h6>
                                <i class="bi bi-chevron-down"></i>
                            </div>

                            <div id="formKesan" class="collapse">
                                <div class="card-body">

                                    @if($alreadySubmitted)
                                        <div class="text-center py-3">
                                            <i class="bi bi-check-circle-fill text-success fs-1"></i>
                                            <p class="mt-2 fw-bold">You have already submitted your testimonial. Thank you!</p>
                                        </div>
                                    @else
                                        <form action="{{ route('kesan.store') }}" method="POST">
                                            @csrf

                                            {{-- Tambahkan NIM Hidden --}}
                                            <input type="hidden" name="nim" value="{{ $mahasiswa?->nim }}">

                                            <div class="mb-3">
                                                <label class="form-label fw-bold" title="Nama">Name</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $mahasiswa?->nama_mahasiswa ?? 'Name Not Found' }}" readonly>

                                                <input type="hidden" name="nama" value="{{ $mahasiswa?->nama_mahasiswa ?? 'Anonymous' }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold" title="Tanggal">Date</label>
                                                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold" title="Kesan">Testimonial</label>
                                                <textarea name="kesan" class="form-control" rows="3" placeholder="Share your experience..." required></textarea>
                                            </div>

                                            <div class="text-end">
                                                <button type="submit" class="btn text-white" style="background:#980517;" title="Simpan">Save</button>
                                            </div>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card"
                        style="border-radius:20px; overflow:hidden; box-shadow:0 8px 20px rgba(0,0,0,0.15);">

                        <div class="card-header text-white text-center"
                            style="background:#980517; font-weight:600; font-size:1.1rem;">
                            Faculty Faculty Notes & Unit Terkait Department Notes
                        </div>

                        <div class="card-body" style="padding:0;">

                            <div class="accordion" id="catatanAccordion">

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#fakultas">
                                            Faculty Notes
                                        </button>
                                    </h2>
                                    <div id="fakultas" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            {{ $pendaftaran?->catatan_fakultas ?? 'No notes available.' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#perpus">
                                            Library Notes
                                        </button>
                                    </h2>
                                    <div id="perpus" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            {{ $pendaftaran?->catatan_perpus ?? 'No notes available.' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#baak">
                                            BAAK Notes
                                        </button>
                                    </h2>
                                    <div id="baak" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            {{ $pendaftaran?->catatan_baak ?? 'No notes available.' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#finance">
                                            Finance Notes
                                        </button>
                                    </h2>
                                    <div id="finance" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            {{ $pendaftaran?->catatan_finance ?? 'No notes available.' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#csdl"
                                            title="Center for Student Data & Learning">
                                            CSDL Notes
                                        </button>
                                    </h2>
                                    <div id="csdl" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            {{ $pendaftaran?->catatan_csdl ?? 'No notes available.' }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('logoutBtn').addEventListener('click', function() {
            if (confirm('Are you sure you want to logout?')) {
                document.getElementById('logoutForm').submit();
            }
        });
    </script>


    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success! 🎉',
            text: "{{ session('success') }}",
            confirmButtonColor: '#980517'
        });
    </script>
    @endif
    @endpush

    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('warning_swal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'warning',
            title: 'Profile Incomplete! ⚠️',
            html: `
                <p>Please <strong>complete your profile</strong> before registering for graduation.</p>
                <p style="font-size:13px;color:#666;">Please fill in your profile details below, then go back to the Graduation Registration page.</p>
            `,
            confirmButtonText: 'OK, Complete My Profile',
            confirmButtonColor: '#980517',
            allowOutsideClick: false
        });
    });
</script>
@endif
</body>

</html>