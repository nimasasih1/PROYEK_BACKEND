@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <h2 class="mb-4">Dashboard Data Wisuda</h2>

  <!-- Alert Success/Error -->
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <!-- Tambahkan wrapper scroll di sini -->
  <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
    <table id="wisudaTable" class="table table-bordered display nowrap" style="width: 100%; min-width: 1800px;">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Nama Mahasiswa</th>
          <th>NIM</th>
          <th>Fakultas</th>
          <th>Prodi</th>
          <th>Tahun</th>
          <th>Tanggal Pendaftaran</th>
          <th>Ukuran</th>
          <th>Catatan</th>
          <th>Tanda Tangan</th>
          <th>Finance</th>
          <th>Perpus</th>
          <th>Fakultas</th>
          <th>BAAK</th>
          <th>Catatan Finance</th>
          <th>Catatan Library</th>
          <th>Catatan Fakulty</th>
          <th>Catatan BAAK</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
<tbody>
    @foreach ($data->unique('id_pendaftaran') as $pendaftaran)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pendaftaran->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $pendaftaran->mahasiswa->nim }}</td>
                <td>{{ $pendaftaran->mahasiswa->fakultas }}</td>
                <td>{{ $pendaftaran->mahasiswa->prodi }}</td>
                <td>{{ $pendaftaran->mahasiswa->tahun }}</td>
                <td>{{ $pendaftaran->tgl_pendaftaran ?? '-' }}</td>
                <td>{{ $pendaftaran->toga->ukuran ?? '-' }}</td>
                <td>{{ $pendaftaran->toga->catatan ?? '-' }}</td>
                <td>
                    @if (!empty($pendaftaran->toga->ttd))
                    <img src="{{ $pendaftaran->toga->ttd }}" alt="Tanda Tangan" width="150">
                    @else
                    -
                    @endif
                </td>

                <!-- VALIDASI FINANCE -->
                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="is_valid_finance">
                        <input type="checkbox" name="is_valid_finance" value="1"
                            onchange="this.form.submit()"
                            {{ $pendaftaran->is_valid_finance ? 'checked' : '' }}>
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
                            {{ $pendaftaran->is_valid_perpus ? 'checked' : '' }}>
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
                            {{ $pendaftaran->is_valid_fakultas ? 'checked' : '' }}>
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

                <!-- ===================== CATATAN FINANCE ===================== -->
                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex align-items-start gap-2" style="width: 500px;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="catatan_finance">
                        <textarea name="catatan_finance" class="form-control" rows="2" placeholder="Tulis catatan finance..." style="flex:2; min-width: 350px;">{{ $pendaftaran->catatan_finance ?? '' }}</textarea>
                        <div class="d-flex flex-column gap-1">
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}">
                                Lihat
                            </button>
                        </div>
                    </form>

                    <!-- Modal Catatan Finance -->
                    <div class="modal fade" id="catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1" aria-labelledby="catatanFinanceLabel{{ $pendaftaran->id_pendaftaran }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="field" value="catatan_finance">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="catatanFinanceLabel{{ $pendaftaran->id_pendaftaran }}">Catatan Finance</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="catatan_finance" class="form-control" rows="5">{{ $pendaftaran->catatan_finance ?? '' }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>

                <!-- ===================== CATATAN PERPUS ===================== -->
                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex align-items-start gap-2" style="width: 500px;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="catatan_perpus">
                        <textarea name="catatan_perpus" class="form-control" rows="2" placeholder="Tulis catatan perpus..." style="flex:2; min-width: 350px;">{{ $pendaftaran->catatan_perpus ?? '' }}</textarea>
                        <div class="d-flex flex-column gap-1">
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#catatanPerpusModal{{ $pendaftaran->id_pendaftaran }}">
                                Lihat
                            </button>
                        </div>
                    </form>

                    <!-- Modal Catatan Perpus -->
                    <div class="modal fade" id="catatanPerpusModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1" aria-labelledby="catatanPerpusLabel{{ $pendaftaran->id_pendaftaran }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="field" value="catatan_perpus">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="catatanPerpusLabel{{ $pendaftaran->id_pendaftaran }}">Catatan Perpustakaan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="catatan_perpus" class="form-control" rows="5">{{ $pendaftaran->catatan_perpus ?? '' }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>

                <!-- ===================== CATATAN FAKULTAS ===================== -->
                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex align-items-start gap-2" style="width: 500px;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="catatan_fakultas">
                        <textarea name="catatan_fakultas" class="form-control" rows="2" placeholder="Tulis catatan fakultas..." style="flex:2; min-width: 350px;">{{ $pendaftaran->catatan_fakultas ?? '' }}</textarea>
                        <div class="d-flex flex-column gap-1">
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#catatanFakultasModal{{ $pendaftaran->id_pendaftaran }}">
                                Lihat
                            </button>
                        </div>
                    </form>

                    <!-- Modal Catatan Fakultas -->
                    <div class="modal fade" id="catatanFakultasModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1" aria-labelledby="catatanFakultasLabel{{ $pendaftaran->id_pendaftaran }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="field" value="catatan_fakultas">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="catatanFakultasLabel{{ $pendaftaran->id_pendaftaran }}">Catatan Fakultas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="catatan_fakultas" class="form-control" rows="5">{{ $pendaftaran->catatan_fakultas ?? '' }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>

                <!-- ===================== CATATAN BAAK ===================== -->
                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex align-items-start gap-2" style="width: 500px;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="catatan_baak">
                        <textarea name="catatan_baak" class="form-control" rows="2" placeholder="Tulis catatan BAAK..." style="flex:2; min-width: 350px;">{{ $pendaftaran->catatan_baak ?? '' }}</textarea>
                        <div class="d-flex flex-column gap-1">
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#catatanBaakModal{{ $pendaftaran->id_pendaftaran }}">
                                Lihat
                            </button>
                        </div>
                    </form>

                    <!-- Modal Catatan BAAK -->
                    <div class="modal fade" id="catatanBaakModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1" aria-labelledby="catatanBaakLabel{{ $pendaftaran->id_pendaftaran }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="field" value="catatan_baak">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="catatanBaakLabel{{ $pendaftaran->id_pendaftaran }}">Catatan BAAK</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="catatan_baak" class="form-control" rows="5">{{ $pendaftaran->catatan_baak ?? '' }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>

                <!-- STATUS -->
                <td>
                    @if($pendaftaran->is_valid_finance && $pendaftaran->is_valid_perpus && $pendaftaran->is_valid_fakultas && $pendaftaran->is_valid_baak)
                    <span class="badge bg-success">Selesai</span>
                    @else
                    <span class="badge bg-warning">Menunggu</span>
                    @endif
                </td>

                <!-- AKSI -->
                <td>
                    <button type="button" class="btn btn-sm btn-warning edit-btn-wisuda"
                        data-id_pendaftaran="{{ $pendaftaran->id_pendaftaran }}"
                        data-tgl="{{ $pendaftaran->tgl_pendaftaran }}"
                        data-ukuran="{{ $pendaftaran->toga->ukuran ?? '' }}"
                        data-catatan="{{ $pendaftaran->toga->catatan ?? '' }}"
                        data-bs-toggle="modal"
                        data-bs-target="#editWisudaModal">
                        Edit
                    </button>

                    <form action="{{ route('wisuda1.destroy', $pendaftaran->id_pendaftaran) }}" method="POST"
                        style="display:inline-block;"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>

<!-- Modal Edit Wisuda -->
<div class="modal fade" id="editWisudaModal" tabindex="-1" aria-labelledby="editWisudaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
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
          
          <div class="mb-3">
            <label for="edit_tgl_pendaftaran" class="form-label">Tanggal Pendaftaran</label>
            <input type="date" class="form-control" id="edit_tgl_pendaftaran" name="tgl_pendaftaran" required>
          </div>

          <div class="mb-3">
            <label for="edit_ukuran" class="form-label">Ukuran Toga</label>
            <select class="form-select" id="edit_ukuran" name="ukuran" required>
              <option value="">Pilih Ukuran</option>
              <option value="S">S</option>
              <option value="M">M</option>
              <option value="L">L</option>
              <option value="XL">XL</option>
              <option value="XXL">XXL</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="edit_catatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="edit_catatan" name="catatan" rows="3" placeholder="Masukkan catatan (opsional)"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Handler untuk tombol edit
  document.querySelectorAll('.edit-btn-wisuda').forEach(function(button) {
    button.addEventListener('click', function() {
      const idPendaftaran = this.getAttribute('data-id_pendaftaran');
      const tglPendaftaran = this.getAttribute('data-tgl');
      const ukuran = this.getAttribute('data-ukuran');
      const catatan = this.getAttribute('data-catatan');

      // Set action form dengan route yang benar
      const form = document.getElementById('editWisudaForm');
      form.action = "{{ route('viewmahasiswa.wisuda1.update', ':id') }}".replace(':id', idPendaftaran);

      // Isi nilai ke form
      document.getElementById('edit_tgl_pendaftaran').value = tglPendaftaran || '';
      document.getElementById('edit_ukuran').value = ukuran || '';
      document.getElementById('edit_catatan').value = catatan || '';
    });
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

  // Inisialisasi DataTable
  if (typeof $.fn.dataTable !== 'undefined') {
    $('#wisudaTable').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
      },
      "pageLength": 10,
      "ordering": true,
      "searching": true,
      "scrollX": true
    });
  }
});
</script>

@endsection