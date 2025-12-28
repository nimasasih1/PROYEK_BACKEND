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

    /* Modal Edit tetap default, tidak diubah */
</style>
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="modal fade" id="importMahasiswaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                {{-- ALERT SESSION DI MODAL --}}
                <!-- @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif -->

                <!-- @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif -->

                {{-- FORM IMPORT --}}
                <form action="{{ route('mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control mb-3" required>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-upload"></i> Import Mahasiswa
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card-custom">
        <h3 class="mb-4" style="color:#980517; font-weight:700;">Daftar Profil Mahasiswa</h3>

        <form method="GET" class="mb-3">
            <div class="row align-items-center">
                <!-- Kolom Tahun -->
                <div class="col-md-3">
                    <select name="tahun" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach($tahunList as $t)
                        <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kolom Tombol -->
                <div class="col-md-9 d-flex gap-2">
                    <button type="button" class="btn btn-outline-primary" id="openUsersModal">
                        <i class="bi bi-people"></i> Users
                    </button>

                    <button type="button" class="btn btn-outline-primary" id="openMahasiswaModal">
                        <i class="bi bi-mortarboard"></i> Mahasiswa
                    </button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table id="profilTable" class="table table-striped table-hover table-bordered display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Fakultas</th>
                        <th>Prodi</th>
                        <th>Tahun</th>
                        <th>Jenjang</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>No. Telp</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $m)
                    <tr style="text-align: center; vertical-align: middle;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $m->nim }}</td>
                        <td>{{ $m->nama_mahasiswa }}</td>
                        <td>{{ $m->fakultas }}</td>
                        <td>{{ $m->prodi }}</td>
                        <td>{{ $m->tahun }}</td>
                        <td>{{ $m->jenjang }}</td>
                        <td>{{ $m->tempat_lahir }}</td>
                        <td>{{ $m->tanggal_lahir }}</td>
                        <td>{{ $m->no_telp }}</td>
                        <td>{{ $m->email }}</td>
                        <td>{{ $m->alamat }}</td>
                        <td class="action-buttons">
                            <button type="button"
                                class="icon-btn edit-btn-profil"
                                data-nim="{{ $m->nim }}"
                                data-nama="{{ $m->nama_mahasiswa }}"
                                data-fakultas="{{ $m->fakultas }}"
                                data-prodi="{{ $m->prodi }}"
                                data-tahun="{{ $m->tahun }}"
                                data-jenjang="{{ $m->jenjang }}"
                                data-tempat_lahir="{{ $m->tempat_lahir }}"
                                data-tanggal_lahir="{{ $m->tanggal_lahir }}"
                                data-no_telp="{{ $m->no_telp }}"
                                data-email="{{ $m->email }}"
                                data-alamat="{{ $m->alamat }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editProfilModal">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <form action="{{ route('profil.destroy', $m->nim) }}"
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
                    @empty
                    <tr>
                        <td colspan="13" class="text-center">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editProfilForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfilModalLabel">Edit Profil Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="edit_nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="edit_nim" name="nim" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama_mahasiswa" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_jenjang">Jenjang</label>
                        <select name="jenjang" id="edit_jenjang" class="form-select" required>
                            <option value="" disabled>Pilih Jenjang</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_fakultas">Fakultas</label>
                        <select name="fakultas" id="edit_fakultas" class="form-select" required onchange="updateProdi()">
                            <option value="" disabled>Pilih Fakultas</option>
                            <option value="FMB">Fakultas Manajemen dan Bisnis</option>
                            <option value="FICT">Fakultas Teknologi Informasi dan Komputer</option>
                            <option value="FHS">Fakultas Ilmu Kesehatan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_prodi">Program Studi</label>
                        <select name="prodi" id="edit_prodi" class="form-select" required>
                            <option value="" disabled>Pilih Program Studi</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="edit_tahun" name="tahun" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_no_telp" class="form-label">No. Telp</label>
                        <input type="text" class="form-control" id="edit_no_telp" name="no_telp">
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="edit_tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="edit_tempat_lahir" name="tempat_lahir">
                    </div>

                    <div class="mb-3">
                        <label for="edit_tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir">
                    </div>

                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="usersActionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kelola Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <div class="d-flex gap-2 justify-content-center">

                    <a href="{{ route('users.template') }}" class="btn btn-outline-primary">
                        <i class="bi bi-file-earmark-arrow-down"></i> Unduh Template Excel
                    </a>

                    <a href="{{ route('users.export') }}" class="btn btn-outline-primary">
                        <i class="bi bi-download"></i> Export
                    </a>

                    <button class="btn btn-outline-success"
                        data-bs-toggle="modal"
                        data-bs-target="#importUsersModal"
                        data-bs-dismiss="modal">
                        <i class="bi bi-upload"></i> Import
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="mahasiswaActionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Kelola Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex flex-wrap justify-content-center gap-3 text-center">

                    <a href="{{ route('mahasiswa.template') }}" class="btn btn-outline-primary">
                        <i class="bi bi-file-earmark-arrow-down me-1"></i>
                        Unduh Template Excel
                    </a>

                    <button class="btn btn-outline-success"
                        data-bs-toggle="modal"
                        data-bs-target="#importMahasiswaModal"
                        data-bs-dismiss="modal">
                        <i class="bi bi-upload me-1"></i>
                        Import Mahasiswa
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="importUsersModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" id="formImportUsers">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Users (CSV / Excel)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="file"
                        name="file"
                        id="fileInput"
                        class="form-control"
                        required
                        accept=".csv,.xlsx,.xls">
                    <small class="text-muted">Format: CSV, XLSX, XLS (Max 2MB)</small>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload"></i> Import
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- <div class="modal fade" id="importMahasiswaModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Mahasiswa (Excel)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="file" name="file" class="form-control" required accept=".xlsx,.csv">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Import</button>
                </div>
            </div>
        </form>
    </div>
</div> -->

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        const prodiOptions = {
            "FMB": ["S1 Manajemen", "S1 Akuntansi"],
            "FICT": ["S1 Informatika", "S1 Sistem Informasi", "S1 Teknik Elektro"],
            "FHS": ["S1 Keperawatan", "S1 Gizi"]
        };

        // DataTable disamakan dengan style kode bawah
        $('#profilTable').DataTable({
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

        // Edit button tetap berfungsi seperti sebelumnya
        window.updateProdi = function() {
            let fakultas = $('#edit_fakultas').val();
            let prodiSelect = $('#edit_prodi');
            prodiSelect.empty().append('<option value="" disabled selected>Pilih Program Studi</option>');
            if (prodiOptions[fakultas]) {
                prodiOptions[fakultas].forEach(p => {
                    prodiSelect.append(`<option value="${p}">${p}</option>`);
                });
            }
        }

        $(document).on('click', '.edit-btn-profil', function() {
            let btn = $(this);
            $('#edit_nim').val(btn.data('nim'));
            $('#edit_nama').val(btn.data('nama'));
            $('#edit_jenjang').val(btn.data('jenjang'));
            $('#edit_fakultas').val(btn.data('fakultas'));
            updateProdi();
            $('#edit_prodi').val(btn.data('prodi'));
            $('#edit_tahun').val(btn.data('tahun'));
            $('#edit_tempat_lahir').val(btn.data('tempat_lahir'));
            $('#edit_tanggal_lahir').val(btn.data('tanggal_lahir'));
            $('#edit_no_telp').val(btn.data('no_telp'));
            $('#edit_email').val(btn.data('email'));
            // Mengambil nilai, memastikan itu string, dan menghapus spasi di awal/akhir
            let alamat = String(btn.data('alamat')).trim();
            $('#edit_alamat').val(alamat);
            $('#editProfilForm').attr('action', '/viewmahasiswa/profil/' + btn.data('nim'));
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

    document.addEventListener('DOMContentLoaded', () => {

        const usersModal = new bootstrap.Modal(document.getElementById('usersActionModal'));
        const mahasiswaModal = new bootstrap.Modal(document.getElementById('mahasiswaActionModal'));

        const openUsersBtn = document.getElementById('openUsersModal');
        const openMahasiswaBtn = document.getElementById('openMahasiswaModal');

        if (openUsersBtn) {
            openUsersBtn.addEventListener('click', () => usersModal.show());
        }

        if (openMahasiswaBtn) {
            openMahasiswaBtn.addEventListener('click', () => mahasiswaModal.show());
        }

    });

    // Debug form submit
    document.getElementById('formImportUsers')?.addEventListener('submit', function(e) {
        const fileInput = document.getElementById('fileInput');
        const file = fileInput.files[0];

        console.log('File selected:', file);
        console.log('File name:', file?.name);
        console.log('File size:', file?.size);
        console.log('File type:', file?.type);

        if (!file) {
            e.preventDefault();
            alert('Pilih file terlebih dahulu!');
        }
    });
</script>

@if(session('success_swal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil 🎉',
            text: '1 data berhasil dihapus.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#980517'
        });
    });
</script>
@endif

@if(session('success1_swal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil 🎉',
            text: '1 data berhasil terupdate.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#980517'
        });
    });
</script>
@endif


@endpush