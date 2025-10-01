@extends('layouts.dashboard')
@include('modals.skpi')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Daftar Pengajuan SKPI</h2>
    <table id="skpiTable" class="table table-bordered display nowrap" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Fakultas</th>
                <th>Prodi</th>
                <th>Tahun</th>
                <th>Tanggal Pengajuan</th>
                <th>Jenjang</th>
                <th>No. HP</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Tanda Tangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                <td>{{ $item->mahasiswa->nama_mahasiswa ?? '-' }}</td>
                <td>{{ $item->mahasiswa->fakultas ?? '-' }}</td>
                <td>{{ $item->mahasiswa->prodi ?? '-' }}</td>
                <td>{{ $item->mahasiswa->tahun ?? '-' }}</td>
                <td>{{ $item->tgl_pengajuan_mahasiswa ?? '-' }}</td>
                <td>{{ $item->jenjang_mahasiswa ?? '-' }}</td>
                <td>{{ $item->no_hp_mahasiswa ?? '-' }}</td>
                <td>{{ $item->email_mahasiswa ?? '-' }}</td>
                <td>{{ $item->alamat_mahasiswa ?? '-' }}</td>
                <td>
                    @if($item->ttd_mahasiswa)
                    <img src="{{ $item->ttd_mahasiswa }}" alt="Tanda Tangan" width="150">
                    @else
                    -
                    @endif
                </td>
                <td>
                    <!-- Tombol Edit -->
                    <button
                        type="button"
                        class="btn btn-sm btn-warning edit-btn-skpi"
                        data-bs-toggle="modal"
                        data-bs-target="#editSkpiModal"
                        data-id="{{ $item->id_skpi }}"
                        data-tgl="{{ $item->tgl_pengajuan_mahasiswa }}"
                        data-jenjang="{{ $item->jenjang_mahasiswa }}"
                        data-hp="{{ $item->no_hp_mahasiswa }}"
                        data-email="{{ $item->email_mahasiswa }}"
                        data-alamat="{{ $item->alamat_mahasiswa }}">
                        Edit
                    </button>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('skpi.destroy', $item->id_skpi) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="13" class="text-center">Belum ada data pengajuan SKPI</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#skpiTable').DataTable({
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

        // Edit SKPI
        $('.edit-btn-skpi').click(function() {
            let btn = $(this);
            $('#edit_id').val(btn.data('id'));
            $('#edit_tgl').val(btn.data('tgl'));
            $('#edit_jenjang').val(btn.data('jenjang'));
            $('#edit_hp').val(btn.data('hp'));
            $('#edit_email').val(btn.data('email'));
            $('#edit_alamat').val(btn.data('alamat'));
            $('#editSkpiForm').attr('action', '/viewmahasiswa/skpi/' + btn.data('id'));
        });
    });
</script>
@endpush