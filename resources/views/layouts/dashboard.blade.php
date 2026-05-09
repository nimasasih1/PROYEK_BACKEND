<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard BAAK</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    @media (min-width: 1200px) {
      .responsive-layout-page {
        margin-left: 260px;
      }
    }
    @media (max-width: 1199.98px) {
      .responsive-layout-page {
        margin-left: 0;
      }
    }
  </style>
</head>

<body>

  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <!-- Sidebar Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme position-fixed top-0 start-0 h-100">
        <div class="app-brand demo">
          <a href="{{ route('dashboard.index') }}" class="app-brand-link align-items-center">
            <span class="app-brand-logo demo">
              <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px; width: auto;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="font-size: 1.3rem;">GRAD-System</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">

          <!-- Home -->
          <li class="menu-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.index') }}" class="menu-link" title="Halaman Utama">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div>Home</div>
            </a>
          </li>

          <!-- Student Data -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text"></span>
          </li>

          <li class="menu-item {{ request()->is('viewmahasiswa/*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle" title="Data Mahasiswa">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
              <div data-i18n="Account Settings">Student Data</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item {{ request()->routeIs('viewmahasiswa.profil_mahasiswa.index') ? 'active' : '' }}">
                <a href="{{ route('viewmahasiswa.profil_mahasiswa.index') }}" class="menu-link" title="Profil Mahasiswa">
                  <i class="menu-icon tf-icons bx bx-user"></i>
                  <div data-i18n="Tables">Student Profile</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('viewmahasiswa.daftar_wisuda1.wisuda1') ? 'active' : '' }}">
                <a href="{{ route('viewmahasiswa.daftar_wisuda1.wisuda1') }}" class="menu-link" title="Daftar Wisuda">
                  <i class="menu-icon tf-icons bx bx-file"></i>
                  <div data-i18n="Tables">Graduation List</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('viewmahasiswa.skpi') ? 'active' : '' }}">
                <a href="{{ route('viewmahasiswa.skpi') }}" class="menu-link" title="Surat Keterangan Pendamping Ijazah">
                  <i class="menu-icon tf-icons bx bx-notepad"></i>
                  <div data-i18n="Tables">SKPI</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('viewmahasiswa.selesai') ? 'active' : '' }}">
                <a href="{{ route('viewmahasiswa.selesai') }}" class="menu-link" title="Rekap Selesai">
                  <i class="menu-icon tf-icons bx bx-check-circle"></i>
                  <div data-i18n="Tables">Toga Completed</div>
                </a>
              </li>

              {{-- ✅ FIX: tambah routeIs active check --}}
              <li class="menu-item {{ request()->routeIs('viewmahasiswa.togaselesai') ? 'active' : '' }}">
                <a href="{{ route('viewmahasiswa.togaselesai') }}" class="menu-link" title="Toga Selesai">
                  <i class="menu-icon tf-icons bx bx-info-circle"></i>
                  <div data-i18n="Tables">Graduation Completed</div>
                </a>
              </li>

              <li class="menu-item {{ request()->routeIs('dashboard.syarat') ? 'active' : '' }}">
                <a href="{{ route('dashboard.syarat') }}" class="menu-link" title="Kelola Syarat & Ketentuan">
                  <i class="menu-icon tf-icons bx bx-list-ul"></i>
                  <div data-i18n="Tables">Manage Requirements</div>
                </a>
              </li>
            </ul>
          </li>

          <!-- Admin -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text"></span>
          </li>

          {{-- ✅ FIX: parent Admin terbuka saat Q&A atau Testimonials aktif --}}
          <li class="menu-item {{ request()->routeIs('dashboard.index1') || request()->routeIs('dashboard.qna') || request()->routeIs('dashboard.kesan') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle" title="Administrator">
              <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
              <div data-i18n="Account Settings">Admin</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item {{ request()->routeIs('dashboard.index1') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index1') }}" class="menu-link" title="Informasi">
                  <i class="menu-icon tf-icons bx bx-info-circle"></i>
                  <div data-i18n="Tables">Information</div>
                </a>
              </li>

              {{-- ✅ FIX: tambah routeIs active check --}}
              <li class="menu-item {{ request()->routeIs('dashboard.qna') ? 'active' : '' }}">
                <a href="{{ route('dashboard.qna') }}" class="menu-link" title="Tanya & Jawab">
                  <i class="menu-icon tf-icons bx bx-help-circle"></i>
                  <div data-i18n="Tables">Q&A</div>
                </a>
              </li>

              {{-- ✅ FIX: tambah routeIs active check --}}
              <li class="menu-item {{ request()->routeIs('dashboard.kesan') ? 'active' : '' }}">
                <a href="{{ route('dashboard.kesan') }}" class="menu-link" title="Kesan & Pesan">
                  <i class="menu-icon tf-icons bx bx-chat"></i>
                  <div data-i18n="StudentTestimonials">Testimonials</div>
                </a>
              </li>
            </ul>
          </li>

          <!-- Settings -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text"></span>
          </li>
          <li class="menu-item {{ request()->routeIs('dashboard.admin') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle" title="Pengaturan">
              <i class="menu-icon tf-icons bx bx-cog"></i>
              <div data-i18n="Settings">Settings</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
                <a href="{{ route('dashboard.admin') }}" class="menu-link" title="Profil Administrator">
                  <i class="menu-icon tf-icons bx bx-id-card"></i>
                  <div data-i18n="Profile">Profile</div>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </aside>

      <!-- Layout container -->
      <div class="layout-page responsive-layout-page">
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center" title="Badan Administrasi Akademik Kemahasiswaan">
                <span class="h5 mb-0">BAAK</span>
              </div>
            </div>

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle d-flex align-items-center"
                  href="{{ route('dashboard.admin') }}"
                  id="userDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ Auth::user()->foto ? asset(Auth::user()->foto) : asset('assets/img/avatars/1.png') }}" alt="User Avatar" class="rounded-circle" width="36" height="36" style="object-fit:cover;">
                  <span class="ms-2 fw-semibold text-dark" title="Pengguna">{{ Auth::user()->name ?? 'User' }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                  <li>
                    <a href="{{ route('dashboard.admin') }}" class="dropdown-item text-dark">
                      <h6 class="mb-0">{{ Auth::user()->name ?? 'User' }}</h6>
                      <small class="text-muted">{{ Auth::user()->email ?? '' }}</small>
                    </a>
                  </li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="button" id="logoutBtn" class="dropdown-item text-danger" title="Keluar (dari akun / sistem)">
                        <i class="bx bx-log-out me-2"></i> Sign Out
                      </button>
                    </form>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')
          </div>

          <footer class="text-center py-3 bg-light border-top mt-4" title="Sistem Wisuda 2025. Semua hak dilindungi.">
            <small>&copy; 2025 Graduation System. All rights reserved.</small>
          </footer>

          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  @push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.getElementById('logoutBtn').addEventListener('click', function() {
      Swal.fire({
        title: '<span title="Apakah Anda yakin?">Are you sure?</span>',
        text: "You will be logged out of the application!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<span title="Yes, logout!">Yes, logout!</span>',
        cancelButtonText: '<span title="Cancel">Cancel</span>'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('logoutForm').submit();
        }
      });
    });
  </script>
  @endpush

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js/menu.js"></script>
  <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/dashboards-analytics.js"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  @stack('scripts')

</body>

</html>