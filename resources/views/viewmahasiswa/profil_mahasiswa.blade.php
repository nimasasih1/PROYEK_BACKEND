@extends('layouts.dashboard')
@include('modals.profil_mahasiswa')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Daftar Profil Mahasiswa</h2>

    <!-- Filter Tahun -->
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <select name="tahun" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Pilih Tahun --</option>
                    @foreach($tahunList as $t)
                        <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <table id="profilTable" class="table table-bordered display nowrap" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Fakultas</th>
                <th>Prodi</th>
                <th>Tahun</th>
                <th>Aksi</th> <!-- Kolom aksi -->
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswa as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->nim }}</td>
                <td>{{ $m->nama_mahasiswa }}</td>
                <td>{{ $m->fakultas }}</td>
                <td>{{ $m->prodi }}</td>
                <td>{{ $m->tahun }}</td>
                <td>
                    <!-- Tombol Edit -->
                    <button type="button" class="btn btn-sm btn-warning edit-btn-profil"
                        data-nim="{{ $m->nim }}"
                        data-nama="{{ $m->nama_mahasiswa }}"
                        data-fakultas="{{ $m->fakultas }}"
                        data-prodi="{{ $m->prodi }}"
                        data-tahun="{{ $m->tahun }}"
                        data-bs-toggle="modal"
                        data-bs-target="#editProfilModal">
                        Edit
                    </button>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('profil.destroy', $m->nim) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#profilTable').DataTable({
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

    // Edit Profil Mahasiswa
    $('.edit-btn-profil').click(function() {
        let btn = $(this);
        $('#edit_nim').val(btn.data('nim'));
        $('#edit_nama').val(btn.data('nama'));
        $('#edit_fakultas').val(btn.data('fakultas'));
        $('#edit_prodi').val(btn.data('prodi'));
        $('#edit_tahun').val(btn.data('tahun'));
        $('#editProfilForm').attr('action', '/viewmahasiswa/profil/' + btn.data('nim'));
    });
});
</script>
@endpush
