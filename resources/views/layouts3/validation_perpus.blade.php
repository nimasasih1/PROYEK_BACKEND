@extends('layouts3.dashboard')
@include('modals.daftar_wisuda1')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard Data Wisuda</h2>

    @php
        $totalMahasiswa = $data->count();
        $sudahCeklis = $data->where('is_valid_perpus', 1)->count();
        $belumCeklis = $totalMahasiswa - $sudahCeklis;
    @endphp
    <div class="mb-3">
        <span class="badge bg-primary me-2">Total Mahasiswa: {{ $totalMahasiswa }}</span>
        <span class="badge bg-success me-2">Approve: {{ $sudahCeklis }}</span>
        <span class="badge bg-warning text-dark">Belum Approve: {{ $belumCeklis }}</span>
    </div>

    <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
    <table id="wisudaTable" class="table table-bordered display nowrap" style="width:100%">
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
                <th>Perpustakaan</th>
                <th>Catatan Perpustakaan</th>
                <th>Status</th>
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

                <!-- Checkbox Perpustakaan -->
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

                <!-- Catatan Perpustakaan -->
                <td>
                    <form action="{{ route('layouts3.validation_perpus.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex align-items-start gap-2" style="width: 500px;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="field" value="catatan_perpus">

                        <!-- Textarea diperlebar dengan flex:2 -->
                        <textarea name="catatan_perpus" class="form-control" rows="2" placeholder="Tulis catatan perpustakaan..." style="flex:2; min-width: 350px;">{{ $pendaftaran->catatan_perpus ?? '' }}</textarea>

                        <!-- Tombol Kirim & Lihat -->
                        <div class="d-flex flex-column gap-1">
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#catatanPerpusModal{{ $pendaftaran->id_pendaftaran }}">
                                Lihat
                            </button>
                        </div>
                    </form>

                    <!-- Modal Catatan Perpustakaan -->
                    <div class="modal fade" id="catatanPerpusModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1" aria-labelledby="catatanPerpusLabel{{ $pendaftaran->id_pendaftaran }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('layouts3.validation_perpus.update', $pendaftaran->id_pendaftaran) }}" method="POST">
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

                <td>
                    @if($pendaftaran->is_valid_finance && $pendaftaran->is_valid_perpus && $pendaftaran->is_valid_fakultas && $pendaftaran->is_valid_baak)
                        <span class="badge bg-success">Selesai</span>
                    @else
                        <span class="badge bg-warning">Menunggu</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#wisudaTable').DataTable().clear().destroy();
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
@endpush
