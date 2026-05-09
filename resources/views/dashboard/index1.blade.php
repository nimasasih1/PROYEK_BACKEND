<!-- resources/views/dashboard/index1.blade.php -->

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
    <h3 class="mb-4" style="color:#980517; font-weight:700;" title="Daftar Informasi Wisuda">Graduation Information List</h3>

    <div class="mb-3">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahInfoModal" title="Tambah informasi wisuda baru">
        + Add Information
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
            <th title="Nomor ID">ID</th>
            <th title="Lokasi Pelaksanaan Wisuda">Location</th>
            <th title="Jumlah Wisudawan">Graduates</th>
            <th title="Jadwal Pelaksanaan Wisuda">Graduation Schedule</th>
            <th title="Informasi dari BAAK">BAAK Information</th>
            <th title="Foto Gallery">Photo</th>
            <th title="Aksi">Action</th>
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
            <td>
              @if($info->foto_gallery)
                <img src="{{ asset($info->foto_gallery) }}" alt="foto" style="width:60px; height:40px; object-fit:cover; border-radius:6px;">
              @else
                <span class="text-muted" style="font-size:0.8rem;">No photo</span>
              @endif
            </td>
            <td class="action-buttons">
              <button type="button" class="icon-btn btn-edit-info"
                data-id="{{ $info->id_info }}"
                data-lokasi="{{ $info->lokasi }}"
                data-jumlah="{{ $info->jumlah_wisudawan }}"
                data-aktif="{{ $info->mahasiswa_aktif }}"
                data-calon="{{ $info->calon_lulusan }}"
                data-jadwal="{{ $info->jadwal_wisuda }}"
                data-baak="{{ $info->informasi_baak }}"
                data-foto="{{ $info->foto_gallery }}"
                data-foto2="{{ $info->foto_gallery_2 }}"
                data-foto3="{{ $info->foto_gallery_3 }}"
                data-foto4="{{ $info->foto_gallery_4 }}"
                data-bs-toggle="modal"
                data-bs-target="#editInfoModal"
                title="Ubah data informasi wisuda">
                <i class="bi bi-pencil"></i>
              </button>

              <form action="{{ route('dashboard.destroy', $info->id_info) }}" method="POST" class="delete-form d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="icon-btn btn-delete"
                  title="Hapus data informasi wisuda ini">
                  <i class="bi bi-trash"></i>
                </button>
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
        <h5 class="modal-title" title="Tambah Informasi Wisuda Baru">Add Graduation Information</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      {{-- ✅ Tambah enctype untuk upload foto --}}
      <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label title="Lokasi Pelaksanaan Wisuda">Location</label>
              <input type="text" name="lokasi" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label title="Jumlah Wisudawan yang Mendaftar">Total Graduates</label>
              <input type="number" name="jumlah_wisudawan" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label title="Jumlah Mahasiswa Aktif">Active Students</label>
              <input type="number" name="mahasiswa_aktif" class="form-control">
            </div>
            <div class="col-md-6">
              <label title="Jumlah Calon Lulusan">Prospective Graduates</label>
              <input type="number" name="calon_lulusan" class="form-control">
            </div>
            <div class="col-md-6">
              <label title="Tanggal Jadwal Wisuda">Graduation Schedule</label>
              <input type="date" name="jadwal_wisuda" class="form-control" required>
            </div>
            <div class="col-12">
              <label title="Informasi dari BAAK">BAAK Information</label>
              <textarea name="informasi_baak" class="form-control" rows="3"></textarea>
            </div>
            {{-- ✅ 4 Field foto gallery --}}
            <div class="col-12">
              <label class="fw-semibold">Gallery Photos <small class="text-muted fw-normal">(Maksimal 4 foto)</small></label>
              <div class="row g-2 mt-1">
                <div class="col-md-6">
                  <label class="text-muted" style="font-size:0.82rem;">Foto 1</label>
                  <input type="file" name="foto_gallery" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="col-md-6">
                  <label class="text-muted" style="font-size:0.82rem;">Foto 2</label>
                  <input type="file" name="foto_gallery_2" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="col-md-6">
                  <label class="text-muted" style="font-size:0.82rem;">Foto 3</label>
                  <input type="file" name="foto_gallery_3" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="col-md-6">
                  <label class="text-muted" style="font-size:0.82rem;">Foto 4</label>
                  <input type="file" name="foto_gallery_4" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                </div>
              </div>
              <small class="text-muted">Format: JPG, PNG, WEBP. Semua opsional.</small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" title="Simpan informasi wisuda baru">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editInfoModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#980517; color:white;">
        <h5 class="modal-title" title="Edit Informasi Wisuda">Edit Graduation Information</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      {{-- ✅ Tambah enctype untuk upload foto --}}
      <form id="formEditInfo" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="row g-3">
            <input type="hidden" name="id_info" id="edit_id">

            <div class="col-md-6">
              <label title="Lokasi Pelaksanaan Wisuda">Location</label>
              <input type="text" name="lokasi" id="edit_lokasi" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label title="Jumlah Wisudawan yang Mendaftar">Total Graduates</label>
              <input type="number" name="jumlah_wisudawan" id="edit_jumlah" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label title="Tanggal Jadwal Wisuda">Graduation Schedule</label>
              <input type="date" name="jadwal_wisuda" id="edit_jadwal" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label title="Jumlah Mahasiswa Aktif">Active Students</label>
              <input type="number" name="mahasiswa_aktif" id="edit_aktif" class="form-control">
            </div>
            <div class="col-md-6">
              <label title="Jumlah Calon Lulusan">Prospective Graduates</label>
              <input type="number" name="calon_lulusan" id="edit_calon" class="form-control">
            </div>
            <div class="col-12">
              <label title="Informasi dari BAAK">BAAK Information</label>
              <textarea name="informasi_baak" id="edit_baak" class="form-control" rows="3"></textarea>
            </div>

            {{-- ✅ 4 Field foto gallery di edit --}}
            <div class="col-12">
              <label class="fw-semibold">Gallery Photos <small class="text-muted fw-normal">(Kosongkan jika tidak ingin ganti)</small></label>
              <div id="preview-foto-edit" class="d-flex gap-2 flex-wrap mb-2"></div>
              <div class="row g-2 mt-1">
                <div class="col-md-6">
                  <label class="text-muted" style="font-size:0.82rem;">Foto 1</label>
                  <input type="file" name="foto_gallery" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="col-md-6">
                  <label class="text-muted" style="font-size:0.82rem;">Foto 2</label>
                  <input type="file" name="foto_gallery_2" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="col-md-6">
                  <label class="text-muted" style="font-size:0.82rem;">Foto 3</label>
                  <input type="file" name="foto_gallery_3" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="col-md-6">
                  <label class="text-muted" style="font-size:0.82rem;">Foto 4</label>
                  <input type="file" name="foto_gallery_4" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" title="Simpan perubahan informasi wisuda">Update</button>
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
        search: "Search:",
        lengthMenu: "Show _MENU_ entries",
        zeroRecords: "No data found",
        info: "Page _PAGE_ of _PAGES_",
        infoEmpty: "No entries available",
        infoFiltered: "(filtered from _MAX_ total entries)",
        paginate: { next: "→", previous: "←" }
      }
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"], [title]'));
    tooltipTriggerList.map(function(el) {
      return new bootstrap.Tooltip(el, { trigger: 'hover', placement: 'top' });
    });

    // Delete confirmation
    document.addEventListener('click', function(e) {
      const btn = e.target.closest('.btn-delete');
      if (!btn) return;
      e.preventDefault();
      const form = btn.closest('.delete-form');
      Swal.fire({
        icon: 'warning',
        title: 'Are you sure you want to delete?',
        text: 'This data will be permanently deleted.',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel',
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
      $('#edit_aktif').val(btn.data('aktif'));
      $('#edit_calon').val(btn.data('calon'));
      $('#edit_jadwal').val(btn.data('jadwal'));
      $('#edit_baak').val(btn.data('baak'));
      $('#formEditInfo').attr('action', '/dashboard/update/' + btn.data('id'));

      // ✅ Preview 4 foto lama
      let fotos = [
        btn.data('foto'),
        btn.data('foto2'),
        btn.data('foto3'),
        btn.data('foto4'),
      ].filter(f => f);

      if (fotos.length > 0) {
        let html = fotos.map(f =>
          `<img src="/${f}" style="height:70px; width:100px; object-fit:cover; border-radius:6px; border:1px solid #ddd;">`
        ).join('');
        $('#preview-foto-edit').html(html + '<small class="d-block text-muted mt-1 w-100">Foto saat ini. Upload baru untuk mengganti.</small>');
      } else {
        $('#preview-foto-edit').html('<small class="text-muted">Belum ada foto.</small>');
      }
    });
  });
</script>

@if(session('success_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon: 'success', title: 'Success!', text: '1 data successfully saved.', confirmButtonText: 'OK', confirmButtonColor: '#980517' });
  });
</script>
@endif

@if(session('success1_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon: 'success', title: 'Success!', text: '1 data successfully updated.', confirmButtonText: 'OK', confirmButtonColor: '#980517' });
  });
</script>
@endif

@if(session('success3_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon: 'success', title: 'Success!', text: '1 data successfully deleted.', confirmButtonText: 'OK', confirmButtonColor: '#980517' });
  });
</script>
@endif
@endpush