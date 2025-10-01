@extends('layouts4.dashboard')
@include('modals.daftar_wisuda1')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Data Wisuda Pending</h2>
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
                <th>Fakultas</th>
                <th>Catataan Fakultas</th>
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

                <td>
                    <form action="{{ route('layouts4.validation_faculty.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex align-items-start gap-2" style="width: 500px;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="catatan_fakultas">

                        <!-- Textarea diperlebar dengan flex:2 -->
                        <textarea name="catatan_fakultas" class="form-control" rows="2" placeholder="Tulis catatan fakultas..." style="flex:2; min-width: 350px;">{{ $pendaftaran->catatan_fakultas ?? '' }}</textarea>

                        <!-- Tombol Kirim & Lihat -->
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
                                <form action="{{ route('layouts4.validation_faculty.update', $pendaftaran->id_pendaftaran) }}" method="POST">
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

                <td><span class="badge bg-warning">Menunggu</span></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
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