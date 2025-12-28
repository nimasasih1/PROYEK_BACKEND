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

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>
  <!-- jQuery and DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">



</head>

<body>

  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <!-- Sidebar Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme position-fixed top-0 start-0 h-100">
        <div class="app-brand demo">
          <a href="{{ route('dashboard.index') }}" class="app-brand-link align-items-center">
            <!-- Ganti SVG ke logo -->
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
          <!-- Dashboard -->
          <li class="menu-item active">
            <a href="{{ route('dashboard.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Beranda</div>
            </a>
          </li>

          <!-- Data Mahasiswa -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text"></span>
          </li>

          <li class="menu-item {{ request()->is('viewmahasiswa/*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
              <div data-i18n="Account Settings">Data Mahasiswa</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item {{ request()->routeIs('viewmahasiswa.profil_mahasiswa.index') ? 'active' : '' }}">
                <a href="{{ route('viewmahasiswa.profil_mahasiswa.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-user"></i>
                  <div data-i18n="Tables">Profil Mahasiswa</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('viewmahasiswa.daftar_wisuda1.wisuda1') ? 'active' : '' }}">
                <a href="{{ route('viewmahasiswa.daftar_wisuda1.wisuda1') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-file"></i>
                  <div data-i18n="Tables">Daftar Wisuda</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('viewmahasiswa.skpi') ? 'active' : '' }}">
                <a href="{{ route('viewmahasiswa.skpi') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-notepad"></i>
                  <div data-i18n="Tables">SKPI</div>
                </a>
              </li>

              <li class="menu-item {{ request()->routeIs('viewmahasiswa.selesai') ? 'active' : '' }}">
                <a href="{{ route('viewmahasiswa.selesai') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-check-circle"></i>
                  <div data-i18n="Tables">Rekap Selesai</div>
                </a>
              </li>

              <li class="menu-item">
                <a href="{{ route('viewmahasiswa.togaselesai') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-info-circle"></i>
                  <div data-i18n="Tables">Toga Selesai</div>
                </a>
              </li>

            </ul>
          </li>

          <!-- Admin -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text"></span>
          </li>

          <li class="menu-item {{ request()->is('dashboard/*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
              <div data-i18n="Account Settings">Admin</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item {{ request()->routeIs('dashboard.index1') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index1') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-info-circle"></i>
                  <div data-i18n="Tables">Informasi</div>
                </a>
              </li>
              <!-- Tambahkan menu-item lain di sini jika ada -->
            </ul>

            <ul class="menu-sub">
              <li class="menu-item">
                <a href="{{ route('dashboard.qna') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-help-circle"></i>
                  <div data-i18n="Tables">Q&A</div>
                </a>
              </li>
            </ul>

            <ul class="menu-sub">
              <li class="menu-item">
                <a href="{{ route('dashboard.kesan') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-chat"></i>
                  <div data-i18n="StudentTestimonials">Kesan & Pesan</div>
                </a>
              </li>
            </ul>
          </li>

          <!-- Pengaturan -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text"></span>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-cog"></i>
              <div data-i18n="Settings">Pengaturan</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="{{ route('dashboard.admin') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-id-card"></i>
                  <div data-i18n="Profile">Profil</div>
                </a>
              </li>
<<<<<<< HEAD
=======

              <li class="menu-item">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="menu-link" style="display: flex; align-items: center; border: none; background: none; padding: 0; cursor: pointer;">
                    <i class="menu-icon tf-icons bx bx-log-out"></i>
                    <div data-i18n="Logout" style="margin-left: 8px;">Logout</div>
                  </button>
                </form>
              </li>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            </ul>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page" style="margin-left: 260px;">
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Judul Halaman -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <span class="h5 mb-0">BAAK</span>
              </div>
            </div>

            <ul class="navbar-nav flex-row align-items-center ms-auto">

              <!-- Profil User -->
              <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle d-flex align-items-center"
                  href="{{ route('dashboard.admin') }}"
                  id="userDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('assets/img/avatars/1.png') }}" alt="User Avatar" class="rounded-circle" width="36" height="36">
                  <span class="ms-2 fw-semibold text-dark">{{ Auth::user()->name ?? 'Pengguna' }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                  <li>
                    <a href="{{ route('dashboard.admin') }}" class="dropdown-item text-dark">
                      <h6 class="mb-0">{{ Auth::user()->name ?? 'User' }}</h6>
                      <small class="text-muted">{{ Auth::user()->email ?? '' }}</small>
                    </a>
                  </li>

                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li>
<<<<<<< HEAD
                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="button" id="logoutBtn" class="dropdown-item text-danger">
=======
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="dropdown-item text-danger">
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
                        <i class="bx bx-log-out me-2"></i> Logout
                      </button>
                    </form>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="text-center py-3 bg-light border-top mt-4">
            <small>&copy; 2025 Sistem Wisuda. All rights reserved.</small>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
<<<<<<< HEAD

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  @push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.getElementById('logoutBtn').addEventListener('click', function() {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan logout dari aplikasi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, logout!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('logoutForm').submit();
        }
      });
    });
  </script>
  @endpush
=======

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91

  <!-- Bootstrap JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <!-- profil -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="../assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../assets/js/dashboards-analytics.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- DataTables initialization -->
  @stack('scripts')
</body>

</html>