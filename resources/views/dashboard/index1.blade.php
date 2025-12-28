@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">

<style>
  .card-custom {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    margin-bottom: 20px;
  }
  .nav-tabs .nav-link {
    color: #980517;
    font-weight: 600;
    border: none;
    padding: 12px 24px;
  }
  .nav-tabs .nav-link.active {
    background: #980517;
    color: white;
    border-radius: 8px 8px 0 0;
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
  table.dataTable thead th {
    background: #980517 !important;
    color: white !important;
    text-align: center;
  }
  .preview-img {
    max-width: 100px;
    max-height: 100px;
    object-fit: cover;
    border-radius: 8px;
  }
</style>

<div class="container-fluid">
  
  <!-- TABS NAVIGATION -->
  <ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#infoWisuda">Informasi Wisuda</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#mediaWisuda">Media Wisuda</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#testimoni">Testimoni</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#statistik">Statistik</a>
    </li>
  </ul>

  <div class="tab-content">
    
    <!-- ========== TAB 1: INFORMASI WISUDA ========== -->
    <div id="infoWisuda" class="tab-pane fade show active">
      <div class="card-custom">
        <h3 class="mb-4" style="color:#980517; font-weight:700;">Daftar Informasi Wisuda</h3>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahInfoModal">
          + Tambah Informasi
        </button>
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="table-responsive">
          <table id="infoTable" class="table table-striped table-hover table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
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
                <td>{{ \Carbon\Carbon::parse($info->jadwal_wisuda)->format('d M Y') }}</td>
                <td>{{ $info->informasi_baak }}</td>
                <td>
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
                  <form action="{{ route('dashboard.destroy', $info->id_info) }}" method="POST" class="d-inline delete-form">
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

    <!-- ========== TAB 2: MEDIA WISUDA ========== -->
    <div id="mediaWisuda" class="tab-pane fade">
      <div class="card-custom">
        <h3 class="mb-4" style="color:#980517; font-weight:700;">Media Wisuda (Carousel)</h3>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahMediaModal">
          + Tambah Media
        </button>

        <div class="table-responsive">
          <table id="mediaTable" class="table table-striped table-hover table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Urutan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mediaWisuda as $media)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img src="{{ asset('storage/'.$media->gambar) }}" class="preview-img"></td>
                <td>{{ $media->judul }}</td>
                <td>{{ Str::limit($media->deskripsi, 50) }}</td>
                <td>{{ $media->urutan }}</td>
                <td>
                  <button type="button" class="icon-btn btn-edit-media"
                    data-id="{{ $media->id }}"
                    data-judul="{{ $media->judul }}"
                    data-deskripsi="{{ $media->deskripsi }}"
                    data-urutan="{{ $media->urutan }}"
                    data-bs-toggle="modal"
                    data-bs-target="#editMediaModal">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <form action="{{ route('dashboard.media.destroy', $media->id) }}" method="POST" class="d-inline delete-form">
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

    <!-- ========== TAB 3: TESTIMONI ========== -->
    <div id="testimoni" class="tab-pane fade">
      <div class="card-custom">
        <h3 class="mb-4" style="color:#980517; font-weight:700;">Testimoni Alumni</h3>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahTestimoniModal">
          + Tambah Testimoni
        </button>

        <div class="table-responsive">
          <table id="testimoniTable" class="table table-striped table-hover table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tahun Lulus</th>
                <th>Testimoni</th>
                <th>Urutan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($testimoni as $testi)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $testi->nama }}</td>
                <td>{{ $testi->tahun_lulus }}</td>
                <td>{{ Str::limit($testi->testimoni, 80) }}</td>
                <td>{{ $testi->urutan }}</td>
                <td>
                  <button type="button" class="icon-btn btn-edit-testimoni"
                    data-id="{{ $testi->id }}"
                    data-nama="{{ $testi->nama }}"
                    data-tahun="{{ $testi->tahun_lulus }}"
                    data-testimoni="{{ $testi->testimoni }}"
                    data-urutan="{{ $testi->urutan }}"
                    data-bs-toggle="modal"
                    data-bs-target="#editTestimoniModal">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <form action="{{ route('dashboard.testimoni.destroy', $testi->id) }}" method="POST" class="d-inline delete-form">
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

    <!-- ========== TAB 4: STATISTIK ========== -->
    <div id="statistik" class="tab-pane fade">
      <div class="card-custom">
        <h3 class="mb-4" style="color:#980517; font-weight:700;">Statistik Kampus</h3>
        
        @if($statistik)
        <form action="{{ route('dashboard.statistik.update') }}" method="POST">
          @csrf
          @method('PUT')
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Total Lulusan</label>
              <input type="number" name="total_lulusan" class="form-control" value="{{ $statistik->total_lulusan }}" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Mahasiswa Aktif</label>
              <input type="number" name="mahasiswa_aktif" class="form-control" value="{{ $statistik->mahasiswa_aktif }}" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Calon Lulusan</label>
              <input type="number" name="calon_lulusan" class="form-control" value="{{ $statistik->calon_lulusan }}" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Update Statistik</button>
        </form>
        @else
        <div class="alert alert-warning">Belum ada data statistik. Silakan tambahkan melalui database atau form.</div>
        @endif
      </div>
    </div>

  </div>
</div>

<!-- ========== MODAL TAMBAH INFO WISUDA ========== -->
<div class="modal fade" id="tambahInfoModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#980517; color:white;">
        <h5 class="modal-title">Tambah Informasi Wisuda</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('dashboard.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label>Lokasi</label>
              <input type="text" name="lokasi" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Jumlah Wisudawan</label>
              <input type="number" name="jumlah_wisudawan" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Jadwal Wisuda</label>
              <input type="date" name="jadwal_wisuda" class="form-control" required>
            </div>
            <div class="col-12">
              <label>Informasi BAAK</label>
              <textarea name="informasi_baak" class="form-control" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ========== MODAL EDIT INFO WISUDA ========== -->
<div class="modal fade" id="editInfoModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#980517; color:white;">
        <h5 class="modal-title">Edit Informasi Wisuda</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formEditInfo" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="hidden" name="id_info" id="edit_id">
          <div class="row g-3">
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

<!-- ========== MODAL TAMBAH MEDIA ========== -->
<div class="modal fade" id="tambahMediaModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#980517; color:white;">
        <h5 class="modal-title">Tambah Media Wisuda</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('dashboard.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label>Judul</label>
              <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Urutan Tampil</label>
              <input type="number" name="urutan" class="form-control" value="0" required>
            </div>
            <div class="col-12">
              <label>Gambar (Max 2MB, JPG/PNG)</label>
              <input type="file" name="gambar" class="form-control" accept="image/*" required>
            </div>
            <div class="col-12">
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ========== MODAL TAMBAH TESTIMONI ========== -->
<div class="modal fade" id="tambahTestimoniModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#980517; color:white;">
        <h5 class="modal-title">Tambah Testimoni</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('dashboard.testimoni.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label>Nama Alumni</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label>Tahun Lulus</label>
              <input type="text" name="tahun_lulus" class="form-control" placeholder="2025" required>
            </div>
            <div class="col-md-3">
              <label>Urutan Tampil</label>
              <input type="number" name="urutan" class="form-control" value="0" required>
            </div>
            <div class="col-12">
              <label>Testimoni</label>
              <textarea name="testimoni" class="form-control" rows="4" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ========== MODAL EDIT TESTIMONI ========== -->
<div class="modal fade" id="editTestimoniModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#980517; color:white;">
        <h5 class="modal-title">Edit Testimoni</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formEditTestimoni" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="hidden" id="edit_testimoni_id">
          <div class="row g-3">
            <div class="col-md-6">
              <label>Nama Alumni</label>
              <input type="text" name="nama" id="edit_testimoni_nama" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label>Tahun Lulus</label>
              <input type="text" name="tahun_lulus" id="edit_testimoni_tahun" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label>Urutan</label>
              <input type="number" name="urutan" id="edit_testimoni_urutan" class="form-control" required>
            </div>
            <div class="col-12">
              <label>Testimoni</label>
              <textarea name="testimoni" id="edit_testimoni_text" class="form-control" rows="4" required></textarea>
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
  // Initialize DataTables
  $('#infoTable, #mediaTable, #testimoniTable').DataTable({
    scrollX: true,
    responsive: true,
    language: {
      search: "Cari:",
      lengthMenu: "Tampilkan _MENU_ data",
      zeroRecords: "Tidak ada data",
      info: "Halaman _PAGE_ dari _PAGES_",
      paginate: { next: "→", previous: "←" }
    }
  });

  // Delete confirmation
  $(document).on('click', '.btn-delete', function(e) {
    e.preventDefault();
    const form = $(this).closest('.delete-form');
    Swal.fire({
      icon: 'warning',
      title: 'Yakin ingin menghapus?',
      text: 'Data akan dihapus permanen',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal',
      confirmButtonColor: '#980517'
    }).then(result => {
      if (result.isConfirmed) form.submit();
    });
  });

  // Edit Info Wisuda
  $('.btn-edit-info').click(function() {
    const btn = $(this);
    $('#edit_id').val(btn.data('id'));
    $('#edit_lokasi').val(btn.data('lokasi'));
    $('#edit_jumlah').val(btn.data('jumlah'));
    $('#edit_jadwal').val(btn.data('jadwal'));
    $('#edit_baak').val(btn.data('baak'));
    $('#formEditInfo').attr('action', '/dashboard/update/' + btn.data('id'));
  });

  // Edit Testimoni
  $('.btn-edit-testimoni').click(function() {
    const btn = $(this);
    $('#edit_testimoni_id').val(btn.data('id'));
    $('#edit_testimoni_nama').val(btn.data('nama'));
    $('#edit_testimoni_tahun').val(btn.data('tahun'));
    $('#edit_testimoni_text').val(btn.data('testimoni'));
    $('#edit_testimoni_urutan').val(btn.data('urutan'));
    $('#formEditTestimoni').attr('action', '/dashboard/testimoni/update/' + btn.data('id'));
  });
});
</script>

@if(session('success_swal'))
<script>
Swal.fire({
  icon: 'success',
  title: 'Berhasil',
  text: 'Data berhasil disimpan',
  confirmButtonColor: '#980517'
});
</script>
@endif

@endpush