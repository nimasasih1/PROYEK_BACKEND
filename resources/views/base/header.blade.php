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
    body {
      font-family: 'Raleway', sans-serif;
      background-color: #f8f9fa;
    }

    .navbar-top {
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      background-color: #ffffff;
    }

    .navbar-brand-logo {
      font-family: 'Radio Canada', sans-serif;
      font-size: 1.5rem;
    }

    .nav-link {
      font-weight: 500;
      color: #566a7f !important;
    }

    .nav-link:hover {
      color: #980517 !important;
    }

    .dropdown-menu {
      min-width: 200px;
    }

    .dropdown-item:hover {
      background-color: #f8f9fa;
      color: #980517 !important;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-top sticky-top">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="navbar-brand navbar-brand-logo d-flex align-items-center" href="#">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="35" height="35" class="me-2">
        <span class="fw-bolder" style="color: #980517;">GRAD-System</span>
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
            <a class="nav-link" href="{{ route('beranda') }}">
              <i class=""></i> Informasi Wisuda
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="menuWisuda" role="button" data-bs-toggle="dropdown">
              <i class=""></i> Menu Wisuda
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Syarat & Ketentuan</a></li>
              <li><a class="dropdown-item" href="{{ route('daftar_wisuda.index') }}">Daftar Wisuda</a></li>
              <li><a class="dropdown-item" href="{{ route('skpi.create') }}">SKPI</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="kontakDropdown" role="button" data-bs-toggle="dropdown">
              <i class=""></i> Kontak
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-start" aria-labelledby="kontakDropdown">
              <li><a class="dropdown-item" href="https://wa.me/6282122993437" target="_blank"><i class="bi bi-whatsapp me-2 text-success"></i>WhatsApp</a></li>
              <li>
                <a class="dropdown-item" href="mailto:nimasasihsubang@gmail.com">
                  <i class="bi bi-envelope me-2 text-primary"></i>Email: nimasasihsubang@gmail.com
                </a>
              </li>
            </ul>
          </li>

          <!-- Profil -->
          <li class="nav-item dropdown mt-2 mt-lg-0 ms-lg-3">
            <a class="nav-link position-relative" href="#" id="profileDropdown" role="button">
              <i class="bi bi-person-circle" style="font-size: 1.8rem; color: #980517;"></i>
              @if($hasCatatan)
              <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
              @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-start" aria-labelledby="profileDropdown">
              <li><a class="dropdown-item" href="{{ route('profil_mahasiswa.show') }}"><i class="bi bi-person me-2"></i> Lihat Profil</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-bell me-2"></i> Notification</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
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
          <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin logout?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

<script>
  const profileLink = document.getElementById('profileDropdown');
  const dropdownMenu = profileLink?.nextElementSibling;

  if (profileLink && dropdownMenu) {
    profileLink.addEventListener('mouseover', () => {
      const dropdown = new bootstrap.Dropdown(profileLink);
      dropdown.show();
    });
    profileLink.addEventListener('mouseleave', () => {
      const dropdown = bootstrap.Dropdown.getInstance(profileLink);
      if (dropdown) dropdown.hide();
    });
    dropdownMenu.addEventListener('mouseover', () => {
      const dropdown = new bootstrap.Dropdown(profileLink);
      dropdown.show();
    });
    dropdownMenu.addEventListener('mouseleave', () => {
      const dropdown = bootstrap.Dropdown.getInstance(profileLink);
      if (dropdown) dropdown.hide();
    });
  }
</script>