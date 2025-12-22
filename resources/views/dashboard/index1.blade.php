@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">

<style>
  .card-custom {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    margin-bottom: 20px;
  }

  .icon-btn {
    border: 1px solid #dadada;
    color: #980517;
    background: #fff;
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: 0.2s;
  }

  .icon-btn:hover {
    background: #f8f8f8;
    border-color: #c7c7c7;
  }

  .action-buttons {
    display: flex;
    gap: 6px;
  }

  table.dataTable thead th {
    background: #980517 !important;
    color: white !important;
    text-align: center;
  }

  table.dataTable tbody tr:hover {
    background-color: #f7f7f7 !important;
  }

  .alert {
    margin: 15px 0;
  }
</style>

<div class="container-fluid">
  <div class="card-custom">
    <h3 class="mb-4" style="color:#980517; font-weight:700;">Daftar Informasi Wisuda</h3>

    <div class="mb-3">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahInfoModal">
        + Tambah Informasi
      </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="table-responsive">
      <table id="infoTable" class="table table-striped table-hover table-bordered display nowrap" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Lokasi</th>
            <th>Jumlah Wisudawan</th>
            <th>Jadwal Wisuda</th>
            <th>Informasi BAAK</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $info)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $info->lokasi }}</td>
            <td>{{ $info->jumlah_wisudawan }}</td>
            <td>{{ $info->jadwal_wisuda }}</td>
            <td>{{ $info->informasi_baak }}</td>
            <td class="action-buttons">
              <button type="button" class="icon-btn btn-edit-info"
                data-id="{{ $info->id_info }}"
                data-lokasi="{{ $info->lokasi }}"
                data-jumlah="{{ $info->jumlah_wisudawan }}"
                data-jadwal="{{ $info->jadwal_wisuda }}"
                data-baak="{{ $info->informasi_baak }}"
                data-bs-toggle="modal"
                data-bs-target="#editInfoModal">
                <i class="bi bi-pencil"></i>
              </button>

              <form action="{{ route('dashboard.destroy', $info->id_info) }}" method="POST" class="delete-form d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="icon-btn btn-delete"><i class="bi bi-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahInfoModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#800000; color:white;">
        <h5 class="modal-title">Tambah Informasi Wisuda</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('dashboard.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label>Lokasi</label><input type="text" name="lokasi" class="form-control" required></div>
            <div class="col-md-6"><label>Jumlah Wisudawan</label><input type="number" name="jumlah_wisudawan" class="form-control" required></div>
            <div class="col-md-6"><label>Jadwal Wisuda</label><input type="date" name="jadwal_wisuda" class="form-control" required></div>
            <div class="col-12"><label>Informasi BAAK</label><textarea name="informasi_baak" class="form-control" rows="3"></textarea></div>
          </div>
        </div>
        <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->

<div class="modal fade" id="editInfoModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#980517; color:white;">
        <h5 class="modal-title">Edit Informasi Wisuda</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formEditInfo" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="row g-3">
            <input type="hidden" name="id_info" id="edit_id">

            <div class="col-md-6">
              <label>Lokasi</label>
              <input type="text" name="lokasi" id="edit_lokasi" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label>Jumlah Wisudawan</label>
              <input type="number" name="jumlah_wisudawan" id="edit_jumlah" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label>Jadwal Wisuda</label>
              <input type="date" name="jadwal_wisuda" id="edit_jadwal" class="form-control" required>
            </div>

            <div class="col-12">
              <label>Informasi BAAK</label>
              <textarea name="informasi_baak" id="edit_baak" class="form-control" rows="3"></textarea>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
  $(document).ready(function() {
    $('#infoTable').DataTable({
      scrollX: true,
      responsive: true,
      autoWidth: false,
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ data",
        zeroRecords: "Tidak ada data ditemukan",
        info: "Halaman _PAGE_ dari _PAGES_",
        paginate: {
          next: "→",
          previous: "←"
        }
      }
    });

    // Delete confirmation
    document.addEventListener('click', function(e) {
      const btn = e.target.closest('.btn-delete');
      if (!btn) return;
      e.preventDefault();
      const form = btn.closest('.delete-form');
      Swal.fire({
        icon: 'warning',
        title: 'Yakin ingin menghapus?',
        text: 'Data ini akan dihapus permanen.',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#980517',
        cancelButtonColor: '#6c757d'
      }).then(result => {
        if (result.isConfirmed) form.submit();
      });
    });

    // Edit modal fill
    $('.btn-edit-info').click(function() {
      let btn = $(this);
      $('#edit_id').val(btn.data('id'));
      $('#edit_lokasi').val(btn.data('lokasi'));
      $('#edit_jumlah').val(btn.data('jumlah'));
      $('#edit_jadwal').val(btn.data('jadwal'));
      $('#edit_baak').val(btn.data('baak'));

      // Form action update
      $('#formEditInfo').attr('action', '/dashboard/update/' + btn.data('id'));
    });
  });
</script>


@if(session('success_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '1 data berhasil tersimpan.',
      confirmButtonText: 'OK',
      confirmButtonColor: '#980517'
    });
  });
</script>
@endif

@if(session('success1_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '1 data berhasil terupdate.',
      confirmButtonText: 'OK',
      confirmButtonColor: '#980517'
    });
  });
</script>
@endif

@if(session('success3_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '1 data berhasil dihapus.',
      confirmButtonText: 'OK',
      confirmButtonColor: '#980517'
    });
  });
</script>
@endif
@endpush        