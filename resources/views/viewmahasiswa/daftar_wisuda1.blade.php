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
    background: #ffffff;
    width: 32px;
    height: 32px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: 0.2s;
  }
  .icon-btn:hover { background: #f8f8f8; border-color: #c7c7c7; }
  .icon-btn i { font-size: 16px; }
  .action-buttons { display: flex; gap: 6px; }
  table.dataTable thead th { background: #980517 !important; color: white !important; text-align: center; }
  table.dataTable tbody tr:hover { background-color: #f7f7f7 !important; }
  .badge-selesai { background: linear-gradient(120deg, #ffffff, #f3f3f3); color: #444; border: 1px solid #dcdcdc; padding: 6px 14px; border-radius: 12px; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
  .btn-catatan { background: #ffffff; border: 1px solid #dadada; transition: 0.2s; }
  .btn-catatan:hover { background: #f8f8f8; border-color: #c7c7c7; }
  .modal-header { padding: 1rem 1.5rem; }
  .badge-menunggu { background: #e9ecef; color: #495057; border: 1px solid #ced4da; padding: 0.35em 0.65em; border-radius: 0.5rem; font-weight: 600; display: inline-block; }
</style>

<div class="container-fluid">
  <div class="card-custom">
    <h3 class="mb-4" style="color:#980517; font-weight:700;" title="Daftar Wisuda">Graduation List</h3>
    <div class="table-responsive">
      <table id="WisudaTable" class="table table-striped table-hover table-bordered display nowrap" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>Faculty</th>
            <th>Study Program</th>
            <th>Year</th>
            <th>GPA</th>
            <th>Thesis Title</th>
            <th>Est. Graduation Date</th>
            <th>Gown Size</th>
            <th>Notes</th>
            <th>Finance</th>
            <th>Library</th>
            <th>Faculty</th>
            <th>CSDL</th>
            <th>BAAK</th>
            <th>Remarks</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data->unique('id_pendaftaran') as $pendaftaran)
          @php
            $isSelesai = $pendaftaran->is_valid_finance &&
                         $pendaftaran->is_valid_perpus &&
                         $pendaftaran->is_valid_fakultas &&
                         $pendaftaran->is_valid_csdl &&
                         $pendaftaran->is_valid_baak;
          @endphp
          @if(!$isSelesai)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pendaftaran->mahasiswa->nama_mahasiswa }}</td>
            <td>{{ $pendaftaran->mahasiswa->nim }}</td>
            <td>{{ $pendaftaran->mahasiswa->fakultas }}</td>
            <td>{{ $pendaftaran->mahasiswa->prodi }}</td>
            <td>{{ $pendaftaran->mahasiswa->tahun }}</td>
            <td class="text-center">
              @if($pendaftaran->ipk)
              <span class="badge @if($pendaftaran->ipk >= 3.5) bg-success @elseif($pendaftaran->ipk >= 3.0) bg-primary @elseif($pendaftaran->ipk >= 2.5) bg-warning text-dark @else bg-danger @endif">
                {{ number_format($pendaftaran->ipk, 2) }}
              </span>
              @if($pendaftaran->ipk >= 3.5)<br><small class="text-success fw-bold">Cum Laude</small>@endif
              @else<span class="text-muted">-</span>@endif
            </td>
            <td>{{ $pendaftaran->judul_skripsi ?? '-' }}</td>
            <td>{{ $pendaftaran->tgl_pendaftaran ?? '-' }}</td>
            <td>{{ $pendaftaran->toga->ukuran ?? '-' }}</td>
            <td>{{ $pendaftaran->toga->catatan ?? '-' }}</td>
            <td><form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="field" value="is_valid_finance"><input type="checkbox" name="is_valid_finance" value="1" onchange="this.form.submit()" {{ $pendaftaran->is_valid_finance ? 'checked' : '' }} disabled></form></td>
            <td><form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="field" value="is_valid_perpus"><input type="checkbox" name="is_valid_perpus" value="1" onchange="this.form.submit()" {{ $pendaftaran->is_valid_perpus ? 'checked' : '' }} disabled></form></td>
            <td><form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="field" value="is_valid_fakultas"><input type="checkbox" name="is_valid_fakultas" value="1" onchange="this.form.submit()" {{ $pendaftaran->is_valid_fakultas ? 'checked' : '' }} disabled></form></td>
            <td><form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="field" value="is_valid_csdl"><input type="checkbox" name="is_valid_csdl" value="1" onchange="this.form.submit()" {{ $pendaftaran->is_valid_csdl ? 'checked' : '' }} disabled></form></td>
            <td><form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="field" value="is_valid_baak"><input type="checkbox" name="is_valid_baak" value="1" onchange="this.form.submit()" {{ $pendaftaran->is_valid_baak ? 'checked' : '' }}></form></td>

            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                  <i class="bi bi-pencil-square"></i> Catatan
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#catatanFakultasModal{{ $pendaftaran->id_pendaftaran }}"><i class="bi bi-building"></i> Fakultas</a></li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}"><i class="bi bi-cash-coin"></i> Keuangan</a></li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#catatanPerpusModal{{ $pendaftaran->id_pendaftaran }}"><i class="bi bi-book"></i> Perpustakaan</a></li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#catatanBaakModal{{ $pendaftaran->id_pendaftaran }}"><i class="bi bi-gear-wide-connected"></i> BAAK</a></li>
                </ul>
              </div>

              <div class="modal fade" id="catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1">
                <div class="modal-dialog"><div class="modal-content">
                  <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="field" value="catatan_finance">
                    <div class="modal-header"><h5 class="modal-title"><i class="bi bi-cash-coin"></i> Catatan Keuangan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body"><textarea name="catatan_finance" class="form-control" rows="5" readonly>{{ $pendaftaran->catatan_finance ?? '' }}</textarea></div>
                    <div class="modal-footer"><button type="submit" class="btn btn-primary"><i class="bi bi-send-fill"></i></button></div>
                  </form>
                </div></div>
              </div>

              <div class="modal fade" id="catatanPerpusModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1">
                <div class="modal-dialog"><div class="modal-content">
                  <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="field" value="catatan_perpus">
                    <div class="modal-header"><h5 class="modal-title"><i class="bi bi-book"></i> Catatan Perpustakaan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body"><textarea name="catatan_perpus" class="form-control" rows="5" readonly>{{ $pendaftaran->catatan_perpus ?? '' }}</textarea></div>
                    <div class="modal-footer"><button type="submit" class="btn btn-primary"><i class="bi bi-send-fill"></i></button></div>
                  </form>
                </div></div>
              </div>

              <div class="modal fade" id="catatanFakultasModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1">
                <div class="modal-dialog"><div class="modal-content">
                  <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="field" value="catatan_fakultas">
                    <div class="modal-header"><h5 class="modal-title"><i class="bi bi-building"></i> Catatan Fakultas</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body"><textarea name="catatan_fakultas" class="form-control" rows="5" readonly>{{ $pendaftaran->catatan_fakultas ?? '' }}</textarea></div>
                    <div class="modal-footer"><button type="submit" class="btn btn-primary"><i class="bi bi-send-fill"></i></button></div>
                  </form>
                </div></div>
              </div>

              <div class="modal fade" id="catatanBaakModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1">
                <div class="modal-dialog"><div class="modal-content">
                  <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="field" value="catatan_baak">
                    <div class="modal-header"><h5 class="modal-title"><i class="bi bi-gear-wide-connected"></i> Catatan BAAK</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body"><textarea name="catatan_baak" class="form-control" rows="5">{{ $pendaftaran->catatan_baak ?? '' }}</textarea></div>
                    <div class="modal-footer"><button type="submit" class="btn btn-primary"><i class="bi bi-send-fill"></i></button></div>
                  </form>
                </div></div>
              </div>
            </td>

            <td><span class="badge badge-menunggu">Pending</span></td>

            <td class="action-buttons">
              <button type="button" class="btn btn-sm btn-outline-primary icon-btn print-btn"
                data-id="{{ $pendaftaran->id_pendaftaran }}" title="Cetak data wisuda">
                <i class="bi bi-printer"></i>
              </button>

              <button type="button" class="btn btn-sm btn-outline-danger icon-btn edit-btn-wisuda"
                data-id_pendaftaran="{{ $pendaftaran->id_pendaftaran }}"
                data-tgl="{{ $pendaftaran->tgl_pendaftaran }}"
                data-ukuran="{{ $pendaftaran->toga->ukuran ?? '' }}"
                data-catatan="{{ $pendaftaran->toga->catatan ?? '' }}"
                data-ipk="{{ $pendaftaran->ipk ?? '' }}"
                data-judul_skripsi="{{ $pendaftaran->judul_skripsi ?? '' }}"
                data-kode_pen="{{ $pendaftaran->toga->kode_pen ?? '' }}"
                data-nama_kaprodi="{{ $pendaftaran->nama_kaprodi ?? '' }}"
                data-nama_dekan="{{ $pendaftaran->nama_dekan ?? '' }}"
                data-bs-toggle="modal"
                data-bs-target="#editWisudaModal"
                title="Ubah data wisuda">
                <i class="bi bi-pencil"></i>
              </button>

              <form action="{{ route('wisuda1.destroy', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-inline delete-form">
                @csrf @method('DELETE')
                <button type="button" class="icon-btn btn-delete" title="Hapus data wisuda ini">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Edit Wisuda -->
<div class="modal fade" id="editWisudaModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editWisudaForm" method="POST">
        @csrf @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Graduation Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="field" value="edit_wisuda">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">GPA</label>
              <input type="number" class="form-control" id="edit_ipk" name="ipk" step="0.01" min="0" max="4.00" placeholder="3.75">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Graduation Date</label>
              <input type="date" class="form-control" id="edit_tgl_pendaftaran" name="tgl_pendaftaran" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Thesis Title</label>
            <textarea class="form-control" id="edit_judul_skripsi" name="judul_skripsi" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">PEN Code <small class="text-muted">(optional)</small></label>
            <input type="text" class="form-control" id="edit_kode_pen" name="kode_pen">
          </div>

          <div class="mb-3">
            <label class="form-label">Gown Size</label>
            <select class="form-select" id="edit_ukuran" name="ukuran" required>
              <option value="">Select Size</option>
              <option value="All Size">All Size</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea class="form-control" id="edit_catatan" name="catatan" rows="3"></textarea>
          </div>

          {{-- ✅ Field baru: Nama Kaprodi & Dekan --}}
          <hr>
          <p class="text-muted mb-2" style="font-size:0.85rem;">
            <i class="bi bi-info-circle me-1"></i>
            Nama berikut akan muncul di print-out. Mereka cukup tanda tangan & isi tanggal manual.
          </p>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label" title="Nama Kepala Program Studi">
                Program Head / Nama Kaprodi
              </label>
              <input type="text" class="form-control" id="edit_nama_kaprodi" name="nama_kaprodi"
                placeholder="e.g. Dr. Budi Santoso, M.Kom">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label" title="Nama Dekan Fakultas">
                Dean / Nama Dekan
              </label>
              <input type="text" class="form-control" id="edit_nama_dekan" name="nama_dekan"
                placeholder="e.g. Prof. Dr. Ahmad, M.M">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $('.print-btn').on('click', function() {
    const id = $(this).data('id');
    window.open('/wisuda/print/' + id, '_blank');
  });
</script>

<script>
  $(document).ready(function() {
    $('#WisudaTable').DataTable({
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

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"], [title]'));
    tooltipTriggerList.map(function(el) {
      return new bootstrap.Tooltip(el, { trigger: 'hover', placement: 'top' });
    });

    setTimeout(function() {
      document.querySelectorAll('.alert').forEach(function(alert) {
        if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
          new bootstrap.Alert(alert).close();
        }
      });
    }, 5000);

    $('.edit-btn-wisuda').on('click', function() {
      const id           = $(this).data('id_pendaftaran');
      const tgl          = $(this).data('tgl');
      const ukuran       = $(this).data('ukuran');
      const catatan      = $(this).data('catatan');
      const ipk          = $(this).data('ipk');
      const judulSkripsi = $(this).data('judul_skripsi');
      const kodePen      = $(this).data('kode_pen');
      const namaKaprodi  = $(this).data('nama_kaprodi');  // ✅
      const namaDekan    = $(this).data('nama_dekan');    // ✅

      $('#editWisudaForm').attr('action', '/viewmahasiswa/wisuda1/' + id);
      $('#edit_tgl_pendaftaran').val(tgl);
      $('#edit_ukuran').val(ukuran);
      $('#edit_catatan').val(catatan);
      $('#edit_ipk').val(ipk);
      $('#edit_judul_skripsi').val(judulSkripsi);
      $('#edit_kode_pen').val(kodePen);
      $('#edit_nama_kaprodi').val(namaKaprodi);  // ✅
      $('#edit_nama_dekan').val(namaDekan);      // ✅
    });

    $('#edit_ipk').on('input', function() {
      if (this.value > 4) this.value = 4.00;
      if (this.value < 0) this.value = 0;
    });
  });

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
    }).then((result) => {
      if (result.isConfirmed) form.submit();
    });
  });
</script>

@if(session('success_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon: 'success', title: 'Success!', text: '1 data was successfully deleted.', confirmButtonText: 'OK', confirmButtonColor: '#980517' });
  });
</script>
@endif

@endpush
@endsection