@extends('layouts.dashboard')

@section('content')
<div class="card">
  <h5 class="card-header">Daftar Informasi Wisuda</h5>

  <div class="px-3 mt-2">
    <a href="{{ route('dashboard.create') }}" class="btn btn-primary mb-3">+ Tambah Informasi</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success mx-3">{{ session('success') }}</div>
  @endif

  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Jadwal Undangan</th>
          <th>Lokasi</th>
          <th>Jumlah Wisudawan</th>
          <th>Jadwal Wisuda</th>
          <th>Informasi BAAK</th>
          <th>Informasi Lulusan</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($data as $info)
        <tr>
          <td><strong>{{ $info->id_info }}</strong></td>
          <td>{{ $info->jadwal_undangan }}</td>
          <td>{{ $info->lokasi }}</td>
          <td>{{ $info->jumlah_wisudawan }}</td>
          <td>{{ $info->jadwal_wisuda }}</td>
          <td>{{ $info->informasi_baak }}</td>
          <td>{{ $info->info_lulusan }}</td>

          <td>
            <form action="{{ route('dashboard.updateStatus', $info->id_info) }}" method="POST">
              @csrf
              @method('PUT')
              <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="draft" {{ $info->status == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="publish" {{ $info->status == 'publish' ? 'selected' : '' }}>Publish</option>
              </select>
            </form>
          </td>

          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('dashboard.edit', $info->id_info) }}">
                  <i class="bx bx-edit-alt me-2"></i> Edit
                </a>
                <form action="{{ route('dashboard.destroy', $info->id_info) }}" method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="dropdown-item text-danger">
                    <i class="bx bx-trash me-2"></i> Hapus
                  </button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection


@push('scripts')
<!-- DataTables JS & CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

 <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
<script>
$(document).ready(function() {
    $('#infoTable').DataTable({
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
@endpush
