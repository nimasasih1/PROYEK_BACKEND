@extends('layouts.dashboard')
@include('modals.daftar_wisuda1')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Data Wisuda Pending</h2>

    <div class="mb-3 d-flex gap-3">
        <form method="GET" action="{{ route('viewmahasiswa.pending') }}">
            <label for="filter" class="form-label">Filter Validasi</label>
            <select name="filter" id="filter" class="form-select" onchange="this.form.submit()">
                <option value="">-- Semua --</option>
                <option value="finance" {{ request('filter')=='finance' ? 'selected' : '' }}>Finance</option>
                <option value="perpus" {{ request('filter')=='perpus' ? 'selected' : '' }}>Perpustakaan</option>
                <option value="fakultas" {{ request('filter')=='fakultas' ? 'selected' : '' }}>Fakultas</option>
                <option value="baak" {{ request('filter')=='baak' ? 'selected' : '' }}>BAAK</option>
            </select>
        </form>
    </div>

    <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
    <table id="wisudaPendingTable" class="table table-bordered display nowrap" style="width:100%">
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
                <th>Library</th>
                <th>Fakultas</th>
                <th>BAAK</th>
                <th>Catatan Fakulty</th>
                <th>Catatan Finance</th>
                <th>Catatan BAAK</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->unique('id_pendaftaran') as $pendaftaran)
            @if(!($pendaftaran->is_valid_finance && $pendaftaran->is_valid_perpus && $pendaftaran->is_valid_fakultas && $pendaftaran->is_valid_baak))
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

                <!-- Checkbox Validasi -->
                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="is_valid_finance">
                        <input type="checkbox" name="is_valid_finance" value="1" onchange="this.form.submit()" {{ $pendaftaran->is_valid_finance ? 'checked' : '' }}>
                    </form>
                </td>

                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="is_valid_perpus">
                        <input type="checkbox" name="is_valid_perpus" value="1" onchange="this.form.submit()" {{ $pendaftaran->is_valid_perpus ? 'checked' : '' }}>
                    </form>
                </td>

                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="is_valid_fakultas">
                        <input type="checkbox" name="is_valid_fakultas" value="1" onchange="this.form.submit()" {{ $pendaftaran->is_valid_fakultas ? 'checked' : '' }}>
                    </form>
                </td>

                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="is_valid_baak">
                        <input type="checkbox" name="is_valid_baak" value="1" onchange="this.form.submit()" {{ $pendaftaran->is_valid_baak ? 'checked' : '' }}>
                    </form>
                </td>

                <!-- Catatan Fakultas -->
                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="catatan_fakultas">
                        <textarea name="catatan_fakultas" class="form-control" rows="2" style="flex:2; min-width:200px;">{{ $pendaftaran->catatan_fakultas ?? '' }}</textarea>
                        <div class="d-flex flex-column gap-1">
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#catatanFakultasModal{{ $pendaftaran->id_pendaftaran }}">Lihat</button>
                        </div>
                    </form>
                </td>

                <!-- Catatan Finance -->
                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="catatan_finance">
                        <textarea name="catatan_finance" class="form-control" rows="2" style="flex:2; min-width:200px;">{{ $pendaftaran->catatan_finance ?? '' }}</textarea>
                        <div class="d-flex flex-column gap-1">
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}">Lihat</button>
                        </div>
                    </form>
                </td>

                <!-- Catatan BAAK -->
                <td>
                    <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="catatan_baak">
                        <textarea name="catatan_baak" class="form-control" rows="2" style="flex:2; min-width:200px;">{{ $pendaftaran->catatan_baak ?? '' }}</textarea>
                        <div class="d-flex flex-column gap-1">
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#catatanBaakModal{{ $pendaftaran->id_pendaftaran }}">Lihat</button>
                        </div>
                    </form>
                </td>

                <td>
                    <span class="badge bg-warning">Menunggu</span>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(function() {
        $('#wisudaPendingTable').DataTable({
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