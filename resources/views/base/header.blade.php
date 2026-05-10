<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GRAD-System Horizon University</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Boxicons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;500;600&family=Radio+Canada:wght@600&display=swap" rel="stylesheet">

  <style>
    /* ========================================
       HEADER STYLES - MATCHING HALAMAN UTAMA
       ======================================== */
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Raleway', sans-serif !important;
      background-color: #f8f9fa !important;
    }

    /* NAVBAR - SOLID WHITE */
    .navbar-top {
      background: #ffffff !important;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08) !important;
      position: sticky !important;
      top: 0 !important;
      z-index: 1000 !important;
      transition: all 0.4s ease !important;
      padding: 0.75rem 0 !important;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
    }

    .navbar-top.scrolled {
      background: #ffffff !important;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.12) !important;
      border-bottom: 1px solid rgba(0, 0, 0, 0.08) !important;
    }

    /* LOGO SECTION - EXACT MATCH */
    .navbar-brand {
      display: flex !important;
      align-items: center !important;
      text-decoration: none !important;
    }

    .logo-navbar {
      height: 42px !important;
      width: auto !important;
      margin-right: 12px !important;
    }

    .logo-wrapper {
      display: flex !important;
      flex-direction: column !important;
      line-height: 1.15 !important;
    }

    .logo-top {
      font-family: 'Radio Canada', sans-serif !important;
      font-weight: 700 !important;
      font-size: 0.95rem !important;
      color: #980517 !important;
      letter-spacing: 0.5px !important;
      text-transform: uppercase !important;
    }

    .logo-bottom {
      font-family: 'Radio Canada', sans-serif !important;
      font-weight: 600 !important;
      font-size: 0.70rem !important;
      color: #555 !important;
      text-transform: uppercase !important;
    }

    /* NAV LINKS - EXACT MATCH */
    .nav-link {
      color: #333 !important;
      font-weight: 500 !important;
      padding: 0.5rem 1rem !important;
      transition: all 0.3s ease !important;
      position: relative !important;
      font-family: 'Raleway', sans-serif !important;
    }

    .nav-link::after {
      content: '' !important;
      position: absolute !important;
      bottom: 0 !important;
      left: 50% !important;
      width: 0 !important;
      height: 2px !important;
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%) !important;
      transition: all 0.3s ease !important;
      transform: translateX(-50%) !important;
    }

    .nav-link:hover::after {
      width: 80% !important;
    }

    .nav-link:hover {
      color: #980517 !important;
    }

    /* DROPDOWN MENU */
    .dropdown-menu {
      min-width: 200px !important;
      border: 1px solid rgba(0, 0, 0, 0.05) !important;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
      border-radius: 10px !important;
      padding: 0.5rem 0 !important;
    }

    .dropdown-item {
      padding: 0.75rem 1.5rem !important;
      font-weight: 500 !important;
      transition: all 0.3s ease !important;
      color: #333 !important;
    }

    .dropdown-item:hover {
      background-color: rgba(152, 5, 23, 0.08) !important;
      color: #980517 !important;
      padding-left: 2rem !important;
    }

    .dropdown-item i {
      margin-right: 8px !important;
      width: 18px !important;
    }

    /* NOTIFICATION BADGE */
    .position-relative .position-absolute {
      width: 10px !important;
      height: 10px !important;
      border: 2px solid white !important;
    }

    /* PROFILE ICON */
    .bi-person-circle {
      font-size: 1.8rem !important;
      color: #980517 !important;
      transition: all 0.3s ease !important;
    }

    .bi-person-circle:hover {
      transform: scale(1.1) !important;
    }

    /* NAVBAR TOGGLER */
    .navbar-toggler {
      border: 2px solid #980517 !important;
      padding: 0.5rem 0.75rem !important;
      transition: all 0.3s ease !important;
    }

    .navbar-toggler:hover {
      background-color: rgba(152, 5, 23, 0.1) !important;
    }

    .navbar-toggler:focus {
      box-shadow: 0 0 0 0.25rem rgba(152, 5, 23, 0.25) !important;
    }

    /* MODAL STYLING */
    .modal-header {
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%) !important;
      color: white !important;
      border-bottom: none !important;
    }

    .modal-header .btn-close {
      filter: brightness(0) invert(1) !important;
    }

    .modal-title {
      font-weight: 600 !important;
      font-family: 'Raleway', sans-serif !important;
    }

    .modal-body {
      padding: 2rem !important;
      font-family: 'Raleway', sans-serif !important;
    }

    .modal-footer {
      border-top: 1px solid rgba(0, 0, 0, 0.1) !important;
    }

    .btn-danger {
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%) !important;
      border: none !important;
      font-weight: 600 !important;
      padding: 0.5rem 1.5rem !important;
      transition: all 0.3s ease !important;
    }

    .btn-danger:hover {
      transform: translateY(-2px) !important;
      box-shadow: 0 5px 15px rgba(152, 5, 23, 0.3) !important;
    }

    .btn-secondary {
      font-weight: 600 !important;
      padding: 0.5rem 1.5rem !important;
    }

    /* ========================================
       RESPONSIVE STYLES
       ======================================== */

    /* Tablet & Mobile */
    @media (max-width: 991px) {
      .logo-wrapper {
        display: none !important;
      }

      .logo-navbar {
        height: 35px !important;
      }

      .navbar-collapse {
        background: white !important;
        padding: 1rem !important;
        margin-top: 1rem !important;
        border-radius: 10px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
      }

      .nav-link {
        padding: 0.75rem 1rem !important;
      }

      .nav-link::after {
        display: none !important;
      }

      .navbar-nav {
        text-align: left !important;
      }

      .dropdown-menu {
        border: none !important;
        box-shadow: none !important;
        background: #f8f9fa !important;
        margin-left: 1rem !important;
      }
    }

    /* Small Mobile */
    @media (max-width: 576px) {
      .navbar-top {
        padding: 0.5rem 0 !important;
      }

      .logo-navbar {
        height: 32px !important;
      }

      .bi-person-circle {
        font-size: 1.5rem !important;
      }

      .modal-body {
        padding: 1.5rem !important;
      }
    }

    /* Extra Small */
    @media (max-width: 375px) {
      .logo-navbar {
        height: 28px !important;
      }

      .navbar-collapse {
        padding: 0.75rem !important;
      }

      .nav-link {
        font-size: 0.9rem !important;
        padding: 0.5rem 0.75rem !important;
      }
    }

    /* Smooth scroll behavior */
    html {
      scroll-behavior: smooth !important;
    }

    /* Selection color */
    ::selection {
      background: #980517 !important;
      color: white !important;
    }

    /* Smooth transitions */
    * {
      transition: margin 0.3s ease, padding 0.3s ease !important;
    }
  </style>
</head>

{{-- ============================================================ --}}
{{-- TAMBAHKAN SCRIPT INI sebelum </body> di base/header.blade   --}}
{{-- (berlaku untuk semua halaman mahasiswa)                     --}}
{{-- ============================================================ --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
(function () {
    // ── KONFIGURASI ──────────────────────────────────────────
    const IDLE_MINUTES    = 20;   // menit tidak ada aktivitas → munculkan warning
    const WARNING_MINUTES = 5;    // menit setelah warning → auto logout
    const LOGOUT_URL      = '{{ route("logout") }}';
    const CSRF_TOKEN      = '{{ csrf_token() }}';
    // ─────────────────────────────────────────────────────────

    const IDLE_MS    = IDLE_MINUTES    * 60 * 1000;
    const WARNING_MS = WARNING_MINUTES * 60 * 1000;

    let idleTimer    = null;
    let logoutTimer  = null;
    let warningShown = false;
    let swalInstance = null;
    let countdown    = WARNING_MINUTES * 60;
    let countdownInterval = null;

    function resetTimers() {
        if (warningShown) return;

        clearTimeout(idleTimer);
        clearTimeout(logoutTimer);

        idleTimer = setTimeout(showWarning, IDLE_MS);
    }

    function showWarning() {
        warningShown = true;
        countdown    = WARNING_MINUTES * 60;

        swalInstance = Swal.fire({
            title: '⚠️ Sesi Akan Berakhir!',
            html: `
                <div style="font-size:1rem; color:#555; margin-bottom:10px;">
                    Tidak ada aktivitas terdeteksi.<br>
                    <em style="font-size:0.85rem; color:#aaa;">No activity detected.</em>
                </div>
                <div style="font-size:2rem; font-weight:700; color:#980517;" id="swal-countdown">
                    ${formatTime(countdown)}
                </div>
                <div style="font-size:0.85rem; color:#888; margin-top:6px;">
                    Sesi akan berakhir otomatis.<br>
                    <em>Session will end automatically.</em>
                </div>
            `,
            icon: 'warning',
            showCancelButton: false,
            confirmButtonText: '✅ Saya masih di sini',
            confirmButtonColor: '#980517',
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then((result) => {
            if (result.isConfirmed) {
                clearCountdown();
                clearTimeout(logoutTimer);
                warningShown = false;
                resetTimers();
            }
        });

        countdownInterval = setInterval(() => {
            countdown--;
            const el = document.getElementById('swal-countdown');
            if (el) el.textContent = formatTime(countdown);

            if (countdown <= 0) {
                clearCountdown();
                doLogout();
            }
        }, 1000);

        logoutTimer = setTimeout(doLogout, WARNING_MS);
    }

    function clearCountdown() {
        clearInterval(countdownInterval);
        clearTimeout(logoutTimer);
    }

    function formatTime(seconds) {
        const m = Math.floor(seconds / 60).toString().padStart(2, '0');
        const s = (seconds % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    }

    function doLogout() {
        if (swalInstance) Swal.close();

        Swal.fire({
            title: 'Sesi Berakhir',
            text: 'Anda telah logout otomatis karena tidak ada aktivitas.',
            icon: 'info',
            confirmButtonColor: '#980517',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
        }).then(() => {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = LOGOUT_URL;

            const csrf = document.createElement('input');
            csrf.type  = 'hidden';
            csrf.name  = '_token';
            csrf.value = CSRF_TOKEN;

            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        });
    }

    const ACTIVITY_EVENTS = ['mousemove', 'mousedown', 'keydown', 'touchstart', 'scroll', 'click'];
    ACTIVITY_EVENTS.forEach(event => {
        document.addEventListener(event, resetTimers, { passive: true });
    });

    resetTimers();

})();
</script>

<body>

@php
$hasCatatan = false;

// ✅ Ambil lastSeen dari DB per user — bukan cookie/session
$lastSeen = (auth()->check() && auth()->user()->notif_last_seen)
    ? \Carbon\Carbon::parse(auth()->user()->notif_last_seen)
    : now()->subDays(30);

$infoTerbaru = \App\Models\Informasi::where('created_at', '>', $lastSeen)->count();

if (auth()->check()) {
    $user = auth()->user();
    $mahasiswa = \App\Models\Mahasiswa::where('nim', $user->username)->first();
    if ($mahasiswa) {
        $pendaftaran = \App\Models\PendaftaranWisuda::whereHas('mahasiswa', function ($q) use ($mahasiswa) {
            $q->where('nim', $mahasiswa->nim);
        })->latest()->first();
        // SESUDAH
$sudahSelesai = $pendaftaran &&
    $pendaftaran->is_valid_finance &&
    $pendaftaran->is_valid_perpus &&
    $pendaftaran->is_valid_fakultas &&
    $pendaftaran->is_valid_baak;

if ($pendaftaran && !$sudahSelesai && (
    $pendaftaran->catatan_fakultas ||
    $pendaftaran->catatan_perpus ||
    $pendaftaran->catatan_baak ||
    $pendaftaran->catatan_finance
)) {
    $hasCatatan = true;
        }
    }
}
@endphp

  <nav class="navbar navbar-expand-lg navbar-top">
    <div class="container-fluid">
      <!-- Brand - EXACT MATCH DENGAN HALAMAN UTAMA -->
      <a class="navbar-brand d-flex align-items-center" href="{{ route('beranda') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-navbar">
        <div class="logo-wrapper">
          <span class="logo-top">GRAD-SYSTEM</span>
          <span class="logo-bottom">Horizon University Indonesia</span>
        </div>
      </a>

      <!-- Toggle -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list" style="font-size:1.5rem; color:#980517;"></i>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-lg-center text-end">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('beranda') }}" title="Informasi Wisuda">
              Graduation Info
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="menuWisuda" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Graduation Menu
            </a>
            <ul class="dropdown-menu" aria-labelledby="menuWisuda">
              <li><a class="dropdown-item" href="{{ route('syarat-ketentuan') }}" title="Syarat & Ketentuan"><i class="bi bi-file-text"></i> Terms & Conditions</a></li>
              <li><a class="dropdown-item" href="{{ route('daftar_wisuda.index') }}" title="Daftar Wisuda"><i class="bi bi-clipboard-check"></i> Register Graduation</a></li>
              <li><a class="dropdown-item" href="{{ route('skpi.create') }}" title="Surat Keterangan Pendamping Ijazah"><i class="bi bi-award"></i> SKPI</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="kontakDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Kontak">
              Contact
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-start" aria-labelledby="kontakDropdown">
              <!-- GANTI WA SAMA EMAIL BAAK -->
<li><a class="dropdown-item" href="https://wa.me/6285891595147" target="_blank">
    <i class="bi bi-whatsapp text-success"></i> WhatsApp</a>
</li>
<li>
    <a class="dropdown-item" href="https://mail.google.com/mail/?view=cm&to=lianasyifafauzia@gmail.com" target="_blank">
    <i class="bi bi-envelope text-primary"></i> Email
</a>
</li>
            </ul>
          </li>

          <!-- Profil -->
          <li class="nav-item dropdown mt-2 mt-lg-0 ms-lg-3">
            <a class="nav-link position-relative" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i>
              @if($hasCatatan || $infoTerbaru > 0)
<span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
@endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-start" aria-labelledby="profileDropdown">
              <li><a class="dropdown-item" href="{{ route('profil_mahasiswa.show') }}" title="Lihat Profil"><i class="bi bi-person"></i> View Profile</a></li>
              <li>
    <a class="dropdown-item position-relative" href="{{ route('notifikasi.baca') }}">
        <i class="bi bi-bell"></i> Notification
        @if($infoTerbaru > 0)
        <span class="badge rounded-pill bg-danger ms-1" style="font-size:0.65rem;">
            {{ $infoTerbaru }}
        </span>
        @endif
    </a>
</li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Logout Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel" title="Konfirmasi Logout">Logout Confirmation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <span title="Apakah Anda yakin ingin logout?">Are you sure you want to logout?</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Batal">Cancel</button>
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Navbar Scroll Effect -->
  <script>
    window.addEventListener("scroll", function () {
      const navbar = document.querySelector(".navbar-top");
      if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    });

    // Initialize all dropdowns on page load
    document.addEventListener('DOMContentLoaded', function() {
      // Enable all dropdowns
      var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
      var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
      });

      // Menu Wisuda Dropdown Hover Effect
      const menuWisudaLink = document.getElementById('menuWisuda');
      const menuWisudaDropdown = menuWisudaLink?.nextElementSibling;

      if (menuWisudaLink && menuWisudaDropdown) {
        menuWisudaLink.addEventListener('mouseover', () => {
          const dropdown = bootstrap.Dropdown.getOrCreateInstance(menuWisudaLink);
          dropdown.show();
        });
        menuWisudaLink.addEventListener('mouseleave', () => {
          setTimeout(() => {
            if (!menuWisudaDropdown.matches(':hover')) {
              const dropdown = bootstrap.Dropdown.getInstance(menuWisudaLink);
              if (dropdown) dropdown.hide();
            }
          }, 100);
        });
        menuWisudaDropdown.addEventListener('mouseover', () => {
          const dropdown = bootstrap.Dropdown.getOrCreateInstance(menuWisudaLink);
          dropdown.show();
        });
        menuWisudaDropdown.addEventListener('mouseleave', () => {
          const dropdown = bootstrap.Dropdown.getInstance(menuWisudaLink);
          if (dropdown) dropdown.hide();
        });
      }

      // Kontak Dropdown Hover Effect
      const kontakLink = document.getElementById('kontakDropdown');
      const kontakDropdownMenu = kontakLink?.nextElementSibling;

      if (kontakLink && kontakDropdownMenu) {
        kontakLink.addEventListener('mouseover', () => {
          const dropdown = bootstrap.Dropdown.getOrCreateInstance(kontakLink);
          dropdown.show();
        });
        kontakLink.addEventListener('mouseleave', () => {
          setTimeout(() => {
            if (!kontakDropdownMenu.matches(':hover')) {
              const dropdown = bootstrap.Dropdown.getInstance(kontakLink);
              if (dropdown) dropdown.hide();
            }
          }, 100);
        });
        kontakDropdownMenu.addEventListener('mouseover', () => {
          const dropdown = bootstrap.Dropdown.getOrCreateInstance(kontakLink);
          dropdown.show();
        });
        kontakDropdownMenu.addEventListener('mouseleave', () => {
          const dropdown = bootstrap.Dropdown.getInstance(kontakLink);
          if (dropdown) dropdown.hide();
        });
      }

      // Profile Dropdown Hover Effect
      const profileLink = document.getElementById('profileDropdown');
      const profileDropdownMenu = profileLink?.nextElementSibling;

      if (profileLink && profileDropdownMenu) {
        profileLink.addEventListener('mouseover', () => {
          const dropdown = bootstrap.Dropdown.getOrCreateInstance(profileLink);
          dropdown.show();
        });
        profileLink.addEventListener('mouseleave', () => {
          setTimeout(() => {
            if (!profileDropdownMenu.matches(':hover')) {
              const dropdown = bootstrap.Dropdown.getInstance(profileLink);
              if (dropdown) dropdown.hide();
            }
          }, 100);
        });
        profileDropdownMenu.addEventListener('mouseover', () => {
          const dropdown = bootstrap.Dropdown.getOrCreateInstance(profileLink);
          dropdown.show();
        });
        profileDropdownMenu.addEventListener('mouseleave', () => {
          const dropdown = bootstrap.Dropdown.getInstance(profileLink);
          if (dropdown) dropdown.hide();
        });
      }
    });
  </script>

</body>
</html>