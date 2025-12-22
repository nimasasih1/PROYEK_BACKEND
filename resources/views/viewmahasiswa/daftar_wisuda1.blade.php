@extends('layouts.dashboard')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">

<style>
  /* Container Card */
  .card-custom {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    margin-bottom: 20px;
  }

  /* Tombol Icon */
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

  .icon-btn:hover {
    background: #f8f8f8;
    border-color: #c7c7c7;
  }

  .icon-btn i {
    font-size: 16px;
  }

  .action-buttons {
    display: flex;
    gap: 6px;
  }

  /* Table Style */
  table.dataTable thead th {
    background: #980517 !important;
    color: white !important;
    text-align: center;
  }

  table.dataTable tbody tr:hover {
    background-color: #f7f7f7 !important;
  }

  /* Badge & Catatan */
  .badge-selesai {
    background: linear-gradient(120deg, #ffffff, #f3f3f3);
    color: #444;
    border: 1px solid #dcdcdc;
    padding: 6px 14px;
    border-radius: 12px;
    font-weight: 600;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .btn-catatan {
    background: #ffffff;
    border: 1px solid #dadada;
    transition: 0.2s;
  }

  .btn-catatan:hover {
    background: #f8f8f8;
    border-color: #c7c7c7;
  }

  .modal-header {
    padding: 1rem 1.5rem;
  }

  .badge-menunggu {
    background: #e9ecef;
    color: #495057;
    border: 1px solid #ced4da;
    padding: 0.35em 0.65em;
    border-radius: 0.5rem;
    font-weight: 600;
    display: inline-block;
  }

  /* Modal Edit tetap default, tidak diubah */
</style>

<div class="container-fluid">
  <div class="card-custom">
    <h3 class="mb-4" style="color:#980517; font-weight:700;">Daftar Wisuda</h3>

    <div class="table-responsive">
      <table id="WisudaTable" class="table table-striped table-hover table-bordered display nowrap" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>Fakultas</th>
            <th>Prodi</th>
            <th>Tahun</th>
            <th>IPK</th>
            <th>Judul Skripsi</th>
            <th>Tanggal Perkiraan Wisuda</th>
            <th>Ukuran</th>
            <th>Catatan</th>
            <th>Keuangan</th>
            <th>Perpus</th>
            <th>Fakultas</th>
            <th>BAAK</th>
            <th>Catatan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data->unique('id_pendaftaran') as $pendaftaran)
          @php
          // Cek apakah semua validasi sudah selesai
          $isSelesai = $pendaftaran->is_valid_finance &&
          $pendaftaran->is_valid_perpus &&
          $pendaftaran->is_valid_fakultas &&
          $pendaftaran->is_valid_baak;
          @endphp

          {{-- Hanya tampilkan data yang BELUM selesai --}}
          @if(!$isSelesai)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pendaftaran->mahasiswa->nama_mahasiswa }}</td>
            <td>{{ $pendaftaran->mahasiswa->nim }}</td>
            <td>{{ $pendaftaran->mahasiswa->fakultas }}</td>
            <td>{{ $pendaftaran->mahasiswa->prodi }}</td>
            <td>{{ $pendaftaran->mahasiswa->tahun }}</td>

            <!-- KOLOM BARU: IPK -->
            <td class="text-center">
              @if($pendaftaran->ipk)
              <span class="badge badge-ipk 
                @if($pendaftaran->ipk >= 3.5) bg-success
                @elseif($pendaftaran->ipk >= 3.0) bg-primary
                @elseif($pendaftaran->ipk >= 2.5) bg-warning text-dark
                @else bg-danger
                @endif">
                {{ number_format($pendaftaran->ipk, 2) }}
              </span>
              @if($pendaftaran->ipk >= 3.5)
              <br><small class="text-success fw-bold">Cum Laude</small>
              @endif
              @else
              <span class="text-muted">-</span>
              @endif
            </td>

            <!-- KOLOM BARU: Judul Skripsi -->
            <td>
              @if($pendaftaran->judul_skripsi)
              <span class="text-truncate-custom"
                title="{{ $pendaftaran->judul_skripsi }}"
                data-bs-toggle="tooltip">
                {{ $pendaftaran->judul_skripsi }}
              </span>
              @else
              <span class="text-muted">-</span>
              @endif
            </td>

            <td>{{ $pendaftaran->tgl_pendaftaran ?? '-' }}</td>
            <td>{{ $pendaftaran->toga->ukuran ?? '-' }}</td>
            <td>{{ $pendaftaran->toga->catatan ?? '-' }}</td>

            <!-- VALIDASI FINANCE -->
            <td>
              <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="field" value="is_valid_finance">
                <input type="checkbox" name="is_valid_finance" value="1"
                  onchange="this.form.submit()"
                  {{ $pendaftaran->is_valid_finance ? 'checked' : '' }} disabled>
              </form>
            </td>

            <!-- VALIDASI PERPUS -->
            <td>
              <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="field" value="is_valid_perpus">
                <input type="checkbox" name="is_valid_perpus" value="1"
                  onchange="this.form.submit()"
                  {{ $pendaftaran->is_valid_perpus ? 'checked' : '' }} disabled>
              </form>
            </td>

            <!-- VALIDASI FAKULTAS -->
            <td>
              <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="field" value="is_valid_fakultas">
                <input type="checkbox" name="is_valid_fakultas" value="1"
                  onchange="this.form.submit()"
                  {{ $pendaftaran->is_valid_fakultas ? 'checked' : '' }} disabled>
              </form>
            </td>

            <!-- VALIDASI BAAK -->
            <td>
              <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="field" value="is_valid_baak">
                <input type="checkbox" name="is_valid_baak" value="1"
                  onchange="this.form.submit()"
                  {{ $pendaftaran->is_valid_baak ? 'checked' : '' }}>
              </form>
            </td>

            <!-- ===================== CATATAN DROPDOWN ===================== -->
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                  id="dropdownCatatan{{ $pendaftaran->id_pendaftaran }}"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-pencil-square"></i> Catatan
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownCatatan{{ $pendaftaran->id_pendaftaran }}">
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                      data-bs-target="#catatanFakultasModal{{ $pendaftaran->id_pendaftaran }}">
                      <i class="bi bi-building"></i> Fakultas
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                      data-bs-target="#catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}">
                      <i class="bi bi-cash-coin"></i> Keuangan
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                      data-bs-target="#catatanPerpusModal{{ $pendaftaran->id_pendaftaran }}">
                      <i class="bi bi-book"></i> Perpustakaan
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                      data-bs-target="#catatanBaakModal{{ $pendaftaran->id_pendaftaran }}">
                      <i class="bi bi-gear-wide-connected"></i> BAAK
                    </a>
                  </li>
                </ul>
              </div>

              <!-- Modal Catatan Finance -->
              <div class="modal fade" id="catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="field" value="catatan_finance">
                      <div class="modal-header">
                        <h5 class="modal-title">
                          <i class="bi bi-cash-coin"></i> Catatan Keuangan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <textarea name="catatan_finance" class="form-control" rows="5" readonly>{{ $pendaftaran->catatan_finance ?? '' }}</textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                          <i class="bi bi-send-fill"></i>
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Modal Catatan Perpus -->
              <div class="modal fade" id="catatanPerpusModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="field" value="catatan_perpus">
                      <div class="modal-header">
                        <h5 class="modal-title">
                          <i class="bi bi-book"></i> Catatan Perpustakaan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <textarea name="catatan_perpus" class="form-control" rows="5" readonly>{{ $pendaftaran->catatan_perpus ?? '' }}</textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                          <i class="bi bi-send-fill"></i>
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Modal Catatan Fakultas -->
              <div class="modal fade" id="catatanFakultasModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="field" value="catatan_fakultas">
                      <div class="modal-header">
                        <h5 class="modal-title">
                          <i class="bi bi-building"></i> Catatan Fakultas
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <textarea name="catatan_fakultas" class="form-control" rows="5" readonly>{{ $pendaftaran->catatan_fakultas ?? '' }}</textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                          <i class="bi bi-send-fill"></i>
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Modal Catatan BAAK -->
              <div class="modal fade" id="catatanBaakModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="field" value="catatan_baak">
                      <div class="modal-header">
                        <h5 class="modal-title">
                          <i class="bi bi-gear-wide-connected"></i> Catatan BAAK
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <textarea name="catatan_baak" class="form-control" rows="5">{{ $pendaftaran->catatan_baak ?? '' }}</textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                          <i class="bi bi-send-fill"></i>
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </td>

            <!-- STATUS -->
            <td>
              <span class="badge badge-menunggu">Menunggu</span>
            </td>

            <!-- AKSI -->
            <!-- AKSI -->
            <td class="action-buttons">
              <!-- Tombol Print (BARU) -->
              <button type="button"
                class="btn btn-sm btn-outline-primary icon-btn print-btn"
                data-id="{{ $pendaftaran->id_pendaftaran }}"
                title="Print Data">
                <i class="bi bi-printer"></i>
              </button>

              <button type="button"
                class="btn btn-sm btn-outline-danger icon-btn edit-btn-wisuda"
                data-id_pendaftaran="{{ $pendaftaran->id_pendaftaran }}"
                data-tgl="{{ $pendaftaran->tgl_pendaftaran }}"
                data-ukuran="{{ $pendaftaran->toga->ukuran ?? '' }}"
                data-catatan="{{ $pendaftaran->toga->catatan ?? '' }}"
                data-ipk="{{ $pendaftaran->ipk ?? '' }}"
                data-judul_skripsi="{{ $pendaftaran->judul_skripsi ?? '' }}"
                data-bs-toggle="modal"
                data-bs-target="#editWisudaModal">
                <i class="bi bi-pencil"></i>
              </button>

              <form action="{{ route('wisuda1.destroy', $pendaftaran->id_pendaftaran) }}"
                method="POST"
                class="d-inline delete-form">
                @csrf
                @method('DELETE')
                <button type="button" class="icon-btn btn-delete">
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
<div class="modal fade" id="editWisudaModal" tabindex="-1" aria-labelledby="editWisudaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editWisudaForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editWisudaModalLabel">Edit Data Wisuda</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="field" value="edit_wisuda">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="edit_ipk" class="form-label">IPK</label>
              <input type="number" class="form-control" id="edit_ipk" name="ipk"
                step="0.01" min="0" max="4.00" placeholder="3.75">
            </div>

            <div class="col-md-6 mb-3">
              <label for="edit_tgl_pendaftaran" class="form-label">Tanggal Wisuda</label>
              <input type="date" class="form-control" id="edit_tgl_pendaftaran" name="tgl_pendaftaran" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="edit_judul_skripsi" class="form-label">Judul Skripsi/Tugas Akhir</label>
            <textarea class="form-control" id="edit_judul_skripsi" name="judul_skripsi"
              rows="3" placeholder="Masukkan judul lengkap"></textarea>
          </div>

          <div class="mb-3">
            <label for="edit_ukuran" class="form-label">Ukuran Toga</label>
            <select class="form-select" id="edit_ukuran" name="ukuran" required>
              <option value="">Pilih Ukuran</option>
              <option value="All Size">All Size</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="edit_catatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="edit_catatan" name="catatan" rows="3"
              placeholder="Masukkan catatan (opsional)"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan Perubahan
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
  // Handle Print Button
  $('.print-btn').on('click', function() {
    const id = $(this).data('id');
    window.open('/wisuda/print/' + id, '_blank');
  });
</script>

<script>
  $(document).ready(function() {
    const prodiOptions = {
      "FMB": ["S1 Manajemen", "S1 Akuntansi"],
      "FICT": ["S1 Informatika", "S1 Sistem Informasi", "S1 Teknik Elektro"],
      "FHS": ["S1 Keperawatan", "S1 Gizi"]
    };

    // DataTable disamakan dengan style kode bawah
    $('#WisudaTable').DataTable({
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

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Auto hide alert setelah 5 detik
    setTimeout(function() {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(function(alert) {
        if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
          const bsAlert = new bootstrap.Alert(alert);
          bsAlert.close();
        }
      });
    }, 5000);

    // Populate edit modal with data
    $('.edit-btn-wisuda').on('click', function() {
      const id = $(this).data('id_pendaftaran');
      const tgl = $(this).data('tgl');
      const ukuran = $(this).data('ukuran');
      const catatan = $(this).data('catatan');
      const ipk = $(this).data('ipk');
      const judulSkripsi = $(this).data('judul_skripsi');

      // Set form action
      $('#editWisudaForm').attr('action', '/viewmahasiswa/wisuda1/' + id);

      // Populate fields
      $('#edit_tgl_pendaftaran').val(tgl);
      $('#edit_ukuran').val(ukuran);
      $('#edit_catatan').val(catatan);
      $('#edit_no_hp').val(noHp);
      $('#edit_email').val(email);
      $('#edit_ipk').val(ipk);
      $('#edit_judul_skripsi').val(judulSkripsi);
    });

    // Validasi IPK real-time
    $('#edit_ipk').on('input', function() {
      if (this.value > 4) {
        this.value = 4.00;
      }
      if (this.value < 0) {
        this.value = 0;
      }
    });
  });

  document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-delete');
    if (!btn) return;

    e.preventDefault();

    const form = btn.closest('.delete-form');

    Swal.fire({
      icon: 'warning',
      title: 'Yakin ingin menghapus?',
      text: 'Data ini akan dihapus secara permanen.',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal',
      confirmButtonColor: '#980517',
      cancelButtonColor: '#6c757d'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
</script>
@endpush

@if(session('success_swal'))
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

@endsection