@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard Data Wisuda (Selesai)</h2>

    <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
    <table id="wisudaSelesaiTable" class="table table-bordered display nowrap" style="width:100%">
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
                <th>Catatan Fakultas</th>
                <th>Catatan Finance</th>
                <th>Catatan Perpus</th>
                <th>Catatan BAAK</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->unique('id_pendaftaran') as $pendaftaran)
            @if($pendaftaran->is_valid_finance && $pendaftaran->is_valid_perpus && $pendaftaran->is_valid_fakultas && $pendaftaran->is_valid_baak)
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
                <td>✔</td>
                <td>✔</td>
                <td>✔</td>
                <td>✔</td>
                <td>{{ $pendaftaran->catatan_fakultas ?? '-' }}</td>
                <td>{{ $pendaftaran->catatan_finance ?? '-' }}</td>
                <td>{{ $pendaftaran->catatan_baak ?? '-' }}</td>
                <td>{{ $pendaftaran->catatan_perpus ?? '-' }}</td>
                <td><span class="badge bg-success">Selesai</span></td>
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
    $(document).ready(function() {
        $('#wisudaSelesaiTable').DataTable({
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

    $(document).on('change', '.toggle-validasi', function() {
        let id = $(this).data('id');
        let field = $(this).data('field');
        let value = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/wisuda1/update-validasi/' + id,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                field: field,
                value: value
            },
            success: function(res) {
                console.log('Berhasil update');
            },
            error: function(err) {
                console.error(err);
            }
        });
    });
</script>
@endpush