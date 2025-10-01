<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Wisuda</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

  <!-- jQuery and DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      /* agar footer tetap di bawah */
    }

    /* Wrapper sidebar + main content */
    .main-wrapper {
      display: flex;
      flex: 1;
      /* ambil sisa tinggi antara header/footer */
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #343a40;
      color: white;
      flex-shrink: 0;
      min-height: 100vh;
    }

    .sidebar .nav-link {
      color: white;
    }

    .sidebar .nav-link:hover {
      background-color: #495057;
    }

    /* Main content */
    .main-content {
      flex-grow: 1;
      background-color: #f8f9fa;
      padding: 20px;
      box-sizing: border-box;
      max-width: calc(100% - 250px);
    }

    /* Navbar shadow */
    .navbar {
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, .075);
    }

    /* Footer */
    footer {
      flex-shrink: 0;
      /* jangan ikut mengecil */
    }

    /* DataTables wrapper agar scroll horizontal muncul */
    div.dataTables_wrapper {
      width: 100%;
      overflow-x: auto;
    }

    /* Optional: agar tabel tidak terlalu rapat */
    table.dataTable th,
    table.dataTable td {
      white-space: nowrap;
    }
  </style>
</head>

<body>

  <!-- Wrapper sidebar + main content -->
  <div class="main-wrapper">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
      <h4 class="text-center mb-4">Menu</h4>
      <ul class="nav nav-pills flex-column mb-auto">
        <li>
          <a class="nav-link d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" href="#mahasiswaSubmenu" role="button"
            aria-expanded="false" aria-controls="mahasiswaSubmenu">
            🎓 Data Mahasiswa
            <span class="ms-2">▼</span>
          </a>

          <div class="collapseshow ps-3" id="mahasiswaSubmenu">
            <ul class="nav flex-column">
              <li><a href="{{ route('layouts3.validation_perpus.index') }}" class="nav-link">📝 Daftar Wisuda</a></li>
              <li><a href="{{ route('layouts3.pending') }}" class="nav-link">📝 Pending</a></li>
            </ul>
          </div>
        </li>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Navbar -->
      <nav class="navbar navbar-light bg-white mb-4 rounded p-3">
        <span class="navbar-brand mb-0 h5">Dashboard Wisuda</span>
        <div class="d-flex">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
          </form>
        </div>
      </nav>

      <!-- Blade content -->
      @yield('content')

    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center py-3 bg-light border-top">
    <small>&copy; 2025 Sistem Wisuda. All rights reserved.</small>
  </footer>

  <!-- Bootstrap JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables initialization -->
  @stack('scripts')
  <script>
    $(document).ready(function() {
      $('#wisudaTable').DataTable({
        scrollX: true,
        autoWidth: false,
        responsive: false,
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ data per halaman",
          zeroRecords: "Tidak ada data yang ditemukan",
          info: "Menampilkan halaman _PAGE_ dari _PAGES_",
          infoEmpty: "Tidak ada data yang tersedia",
          infoFiltered: "(difilter dari _MAX_ total data)",
          paginate: {
            first: "Pertama",
            last: "Terakhir",
            next: "Selanjutnya",
            previous: "Sebelumnya"
          }
        }
      });
    });
  </script>
</body>

</html>