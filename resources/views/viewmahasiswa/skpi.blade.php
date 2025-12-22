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

    .icon-btn:hover {
        background: #f8f8f8;
        border-color: #c7c7c7;
    }

    .icon-btn i {
        font-size: 16px;
    }

    .icon-btn.btn-print {
        color: #980517;
    }

    .icon-btn.btn-print:hover {
        background: #e7f1ff;
        border-color: #980517;
    }

    .action-buttons {
        display: flex;
        gap: 6px;
    }

    table.dataTable thead th {
        background: #980517 !important;
        color: white !important;
        text-align: center;
    }

    table.dataTable tbody tr:hover {
        background-color: #f7f7f7 !important;
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
</style>

<div class="container-fluid">
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0" style="color:#980517; font-weight:700;">
                Daftar Pengajuan SKPI
            </h3>

            <div class="d-flex gap-2">


                <!-- <button type="button" class="btn btn-outline-primary" id="openSkpiModal">
                    <i class="bi bi-people me-1"></i>
                    Upload kelanjutan Skpi
                </button> -->
            </div>
        </div>

        <div class="table-responsive">
            <table id="skpiTable" class="table table-striped table-hover table-bordered display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Tahun Lulus</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>No Ijazah</th>
                        <th>NIM</th>
                        <th>Gelar</th>

                        <th>SK Pendirian Perti</th>
                        <th>Persyaratan Penerimaan</th>
                        <th>Nama Perguruan Tinggi</th>
                        <th>Bahasa Pengantar</th>
                        <th>Program Studi</th>
                        <th>Sistem Penilaian</th>
                        <th>Kelas</th>
                        <th>Lama Studi</th>
                        <th>Jenis & Jenjang Pendidikan</th>
                        <th>Jenjang Pendidikan Lanjutan</th>
                        <th>Jenjang KKNI</th>
                        <th>Status Profesi</th>

                        <th>Kemampuan Kerja</th>
                        <th>Penguasaan Pengetahuan</th>
                        <th>Aktivitas & Penghargaan</th>
                        <th>Magang</th>

                        <th>Jenjang & Syarat Belajar</th>
                        <th>SKS Lama Studi</th>

                        <th>Info KKNI</th>

                        <th>Kota</th>
                        <th>Tanggal SKPI</th>
                        <th>Tanggal Pengajuan</th>
                        <th>File PDF</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- NAMA MAHASISWA (DARI TABEL MAHASISWA) --}}
                        <td>
                            {{ $item->mahasiswa->nama_mahasiswa ?? '-' }}
                        </td>

                        <td>{{ $item->tahun_lulus ?? '-' }}</td>

                        <td>{{ $item->tempat_lahir ?? '-' }}</td>

                        {{-- TANGGAL LAHIR (DARI TABEL MAHASISWA) --}}
                        <td>
                            {{ $item->mahasiswa->tanggal_lahir
                ? \Carbon\Carbon::parse($item->mahasiswa->tanggal_lahir)->format('d-m-Y')
                : '-' }}
                        </td>

                        <td>{{ $item->no_ijazah ?? '-' }}</td>

                        <td>{{ $item->mahasiswa->nim ?? '-' }}</td>

                        <td>{{ $item->gelar ?? '-' }}</td>

                        <td>{{ $item->nama_perti ?? 'Universitas Horizon Indonesia' }}</td>

                        <td>{{ $item->persyaratan_penerimaan ?? '-' }}</td>

                        <td>{{ $item->nama_perti ?? '-' }}</td>

                        <td>{{ $item->bahasa_pengantar_kuliah ?? '-' }}</td>

                        <td>{{ $item->mahasiswa->prodi ?? '-' }}</td>

                        <td>{{ $item->sistem_penilaian ?? '-' }}</td>

                        <td>{{ $item->kelas ?? '-' }}</td>

                        <td>{{ $item->lama_studi_rg ?? '-' }}</td>

                        {{-- JENIS / JENJANG PENDIDIKAN (DARI MAHASISWA) --}}
                        <td>{{ $item->mahasiswa->jenjang ?? '-' }}</td>

                        <td>{{ $item->jenjang_pd_lanjutan ?? '-' }}</td>

                        <td>{{ $item->jenjang_kualif_kkn1 ?? '-' }}</td>

                        <td>{{ $item->status_profesi ?? '-' }}</td>

                        {{-- KEMAMPUAN KERJA --}}
                        <td>{{ $item->kemampuan_kerja ?? '-' }}</td>

                        <td>{{ $item->penguasaan_pengetahuan ?? '-' }}</td>

                        <td>{{ $item->aktiv_pres_penghargaan ?? '-' }}</td>

                        <td>{{ $item->magang ?? '-' }}</td>

                        <td>{{ $item->jenjangpend_syaratbelajar ?? '-' }}</td>

                        <td>{{ $item->sks_lamastudi ?? '-' }}</td>

                        {{-- INFO KKNI --}}
                        <td>{{ $item->info_kkni ?? '-' }}</td>

                        <td>{{ $item->kota ?? '-' }}</td>

                        <td>
                            {{ $item->tanggal_skpi
                ? \Carbon\Carbon::parse($item->tanggal_skpi)->format('d-m-Y')
                : '-' }}
                        </td>

                        <td>
                            {{ $item->tgl_pengajuan_mahasiswa
                ? \Carbon\Carbon::parse($item->tgl_pengajuan_mahasiswa)->format('d-m-Y')
                : '-' }}
                        </td>

                        {{-- FILE PDF --}}
                        <td class="text-center">
                            @if($item->file_pdf)
                            <a href="{{ asset('skpi/' . $item->file_pdf) }}"
                                target="_blank"
                                class="btn btn-sm btn-danger">
                                PDF
                            </a>
                            @else
                            -
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="text-center">
                            <div class="action-buttons">
                                {{-- TOMBOL PRINT --}}
                                <button
                                    type="button"
                                    class="icon-btn btn-print"
                                    onclick="printSkpiData({{ $item->id_skpi }})"
                                    title="Print Data SKPI">
                                    <i class="bi bi-printer"></i>
                                </button>

                                {{-- TOMBOL EDIT --}}
                                <button
                                    type="button"
                                    class="icon-btn edit-btn-skpi"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editSkpiModal"
                                    data-action="{{ route('skpi.update', $item->id_skpi) }}"

                                    {{-- DATA MAHASISWA --}}
                                    data-nim="{{ $item->mahasiswa->nim ?? '' }}"
                                    data-nama="{{ $item->mahasiswa->nama_mahasiswa ?? '' }}"
                                    data-fakultas="{{ $item->mahasiswa->fakultas ?? '' }}"
                                    data-prodi="{{ $item->mahasiswa->prodi ?? '' }}"
                                    data-jenjang="{{ $item->mahasiswa->jenjang ?? '' }}"

                                    {{-- DATA UMUM --}}
                                    data-tempat_lahir="{{ $item->tempat_lahir ?? '' }}"
                                    data-tgl_lahir="{{ $item->tgl_lahir ?? '' }}"
                                    data-tgl_pengajuan="{{ $item->tgl_pengajuan_mahasiswa ?? '' }}"

                                    {{-- PRESTASI --}}
                                    data-achievement="{{ $item->aktiv_pres_penghargaan ?? '' }}"
                                    data-magang="{{ $item->magang ?? '' }}"

                                    {{-- DATA BAAK --}}
                                    data-tahun_lulus="{{ $item->tahun_lulus ?? '' }}"
                                    data-no_ijazah="{{ $item->no_ijazah ?? '' }}"
                                    data-gelar="{{ $item->gelar ?? '' }}"
                                    data-sk_pendirian="{{ $item->sk_pendirian_perti ?? '' }}"
                                    data-persyaratan="{{ $item->persyaratan_penerimaan ?? '' }}"
                                    data-nama_perti="{{ $item->nama_perti ?? '' }}"
                                    data-bahasa="{{ $item->bahasa_pengantar_kuliah ?? '' }}"
                                    data-sistem_penilaian="{{ $item->sistem_penilaian ?? '' }}"
                                    data-kelas="{{ $item->kelas ?? '' }}"
                                    data-lama_studi="{{ $item->lama_studi_rg ?? '' }}"
                                    data-jenjang_pd="{{ $item->jenjang_pd_lanjutan ?? '' }}"
                                    data-jenjang_kkni="{{ $item->jenjang_kualif_kkn1 ?? '' }}"
                                    data-status_profesi="{{ $item->status_profesi ?? '' }}"
                                    data-kemampuan="{{ $item->kemampuan_kerja ?? '' }}"
                                    data-pengetahuan="{{ $item->penguasaan_pengetahuan ?? '' }}"
                                    data-jenjang_syarat="{{ $item->jenjangpend_syaratbelajar ?? '' }}"
                                    data-sks="{{ $item->sks_lamastudi ?? '' }}"
                                    data-info_kkni="{{ $item->info_kkni ?? '' }}"
                                    data-kota="{{ $item->kota ?? '' }}"
                                    data-tgl_skpi="{{ $item->tanggal_skpi ?? '' }}"
                                    data-dekan="{{ $item->nama_dekan ?? '' }}"
                                    title="Edit Data SKPI">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                {{-- TOMBOL DELETE --}}
                                <form action="{{ route('skpi.destroy', $item->id_skpi) }}"
                                    method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="icon-btn btn-delete" title="Hapus Data SKPI">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="32" class="text-center">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="skpiActionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kelola Skpi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <div class="d-flex gap-2 justify-content-center">

                    <a href="{{ route('skpi.template') }}" class="btn btn-outline-primary">
                        <i class="bi bi-file-earmark-arrow-down"></i> Unduh Template Excel
                    </a>

                    <a href="{{ route('skpi.export') }}" class="btn btn-outline-primary">
                        <i class="bi bi-download"></i> Export
                    </a>

                    <button class="btn btn-outline-success"
                        data-bs-toggle="modal"
                        data-bs-target="#importSkpiModal"
                        data-bs-dismiss="modal">
                        <i class="bi bi-upload"></i> Import
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="importSkpiModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('skpi.import') }}" method="POST" enctype="multipart/form-data" id="formImportSkpi">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import SKPI (CSV / Excel)</h5>
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

<!-- Modal Edit SKPI -->
<div class="modal fade" id="editSkpiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="editSkpiForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- WAJIB karena controller butuh --}}
                <input type="hidden"
                    name="tgl_pengajuan_mahasiswa"
                    id="edit_tgl_pengajuan_mahasiswa">

                <div class="modal-header">
                    <h5 class="modal-title">📝 Lengkapi Data SKPI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body" style="max-height:70vh; overflow-y:auto;">

                    {{-- DATA MAHASISWA --}}
                    <h6 class="text-primary mb-3">👤 Data Mahasiswa</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>NIM</label>
                            <input type="text" id="edit_nim" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nama</label>
                            <input type="text" id="edit_nama" class="form-control" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Fakultas</label>
                            <input type="text" id="edit_fakultas" class="form-control" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Prodi</label>
                            <input type="text" id="edit_prodi" class="form-control" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Jenjang</label>
                            <input type="text" id="edit_jenjang" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tempat Lahir</label>
                            <input type="text"
                                id="edit_tempat_lahir"
                                name="tempat_lahir"
                                class="form-control"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Lahir</label>
                            <input type="date"
                                id="edit_tgl_lahir"
                                name="tgl_lahir"
                                class="form-control"
                                readonly>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Achievement</label>
                            <textarea id="edit_achievement"
                                name="aktiv_pres_penghargaan"
                                class="form-control"
                                rows="3"
                                readonly></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Magang</label>
                            <textarea id="edit_magang"
                                name="magang"
                                class="form-control"
                                rows="3"
                                readonly></textarea>
                        </div>
                    </div>
                    <hr>
                    {{-- DATA BAAK --}}
                    <h6 class="text-danger mb-3">🔧 Data yang Dilengkapi BAAK</h6>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Tahun Lulus</label>
                            <input type="number"
                                name="tahun_lulus"
                                id="edit_tahun_lulus"
                                class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>No Ijazah</label>
                            <input type="text"
                                name="no_ijazah"
                                id="edit_no_ijazah"
                                class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Gelar</label>
                            <input type="text"
                                name="gelar"
                                id="edit_gelar"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>SK Pendirian PT</label>
                            <input type="text"
                                name="sk_pendirian_perti"
                                id="edit_sk_pendirian"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Persyaratan Penerimaan</label>
                            <input type="text"
                                name="persyaratan_penerimaan"
                                id="edit_persyaratan"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Bahasa Pengantar</label>
                            <input type="text"
                                name="bahasa_pengantar_kuliah"
                                id="edit_bahasa"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sistem Penilaian</label>
                            <input type="text"
                                name="sistem_penilaian"
                                id="edit_sistem_penilaian"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Kelas</label>
                            <input type="text"
                                name="kelas"
                                id="edit_kelas"
                                class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Lama Studi</label>
                            <input type="text"
                                name="lama_studi_rg"
                                id="edit_lama_studi"
                                class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Jenjang Lanjutan</label>
                            <input type="text"
                                name="jenjang_pd_lanjutan"
                                id="edit_jenjang_pd"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Jenjang KKNI</label>
                            <input type="text"
                                name="jenjang_kualif_kkn1"
                                id="edit_jenjang_kkni"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status Profesi</label>
                            <input type="text"
                                name="status_profesi"
                                id="edit_status_profesi"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Kemampuan Kerja</label>
                        <textarea name="kemampuan_kerja"
                            id="edit_kemampuan"
                            class="form-control"
                            rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Penguasaan Pengetahuan</label>
                        <textarea name="penguasaan_pengetahuan"
                            id="edit_pengetahuan"
                            class="form-control"
                            rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Jenjang & Syarat Belajar</label>
                            <input type="text"
                                name="jenjangpend_syaratbelajar"
                                id="edit_jenjang_syarat"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>SKS & Lama Studi</label>
                            <input type="text"
                                name="sks_lamastudi"
                                id="edit_sks"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Informasi KKNI</label>
                        <textarea name="info_kkni"
                            id="edit_kkni"
                            class="form-control"
                            rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Kota</label>
                            <input type="text"
                                name="kota"
                                id="edit_kota"
                                class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Tanggal SKPI</label>
                            <input type="date"
                                name="tanggal_skpi"
                                id="edit_tgl_skpi"
                                class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Nama Dekan</label>
                            <input type="text"
                                name="nama_dekan"
                                id="edit_dekan"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Upload File SKPI (PDF)</label>
                            <input type="file"
                                name="file_pdf"
                                class="form-control"
                                accept="application/pdf">
                            <small class="text-muted">
                                Format PDF, maksimal 2MB (opsional)
                            </small>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
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
    $(document).ready(function() {
        $('#skpiTable').DataTable({
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

        // Populate edit modal
        $(document).on('click', '.edit-btn-skpi', function() {
            const btn = $(this);

            $('#editSkpiForm').attr('action', btn.data('action'));

            $('#edit_nim').val(btn.data('nim'));
            $('#edit_nama').val(btn.data('nama'));
            $('#edit_fakultas').val(btn.data('fakultas'));
            $('#edit_prodi').val(btn.data('prodi'));
            $('#edit_jenjang').val(btn.data('jenjang'));
            $('#edit_tempat_lahir').val(btn.data('tempat_lahir'));
            $('#edit_tgl_lahir').val(btn.data('tgl_lahir'));
            $('#edit_achievement').val(btn.data('achievement'));
            $('#edit_magang').val(btn.data('magang'));

            $('#edit_tahun_lulus').val(btn.data('tahun_lulus'));
            $('#edit_no_ijazah').val(btn.data('no_ijazah'));
            $('#edit_gelar').val(btn.data('gelar'));
            $('#edit_sk_pendirian').val(btn.data('sk_pendirian'));
            $('#edit_persyaratan').val(btn.data('persyaratan'));
            $('#edit_bahasa').val(btn.data('bahasa'));
            $('#edit_sistem_penilaian').val(btn.data('sistem_penilaian'));
            $('#edit_kelas').val(btn.data('kelas'));
            $('#edit_lama_studi').val(btn.data('lama_studi'));
            $('#edit_jenjang_pd').val(btn.data('jenjang_pd'));
            $('#edit_jenjang_kkni').val(btn.data('jenjang_kkni'));
            $('#edit_status_profesi').val(btn.data('status_profesi'));
            $('#edit_kemampuan_kerja').val(btn.data('kemampuan_kerja'));
            $('#edit_pengetahuan').val(btn.data('pengetahuan'));
            $('#edit_jenjang_syarat').val(btn.data('jenjang_syarat'));
            $('#edit_sks').val(btn.data('sks'));
            $('#edit_kkni').val(btn.data('info_kkni'));
            $('#edit_kota').val(btn.data('kota'));
            $('#edit_tgl_skpi').val(btn.data('tanggal_skpi'));
            $('#edit_dekan').val(btn.data('nama_dekan'));

            $('#edit_tgl_pengajuan_mahasiswa').val(btn.data('tgl_pengajuan'));
        });

        // Validasi tahun lulus
        $('#edit_tahun_lulus').on('input', function() {
            const year = new Date().getFullYear();
            if (this.value < 2000) this.value = 2000;
            if (this.value > year) this.value = year;
        });
    });

    // Fungsi Print SKPI
    function printSkpiData(idSkpi) {
        // Buka halaman print di tab baru
        const printUrl = '/skpi/print/' + idSkpi;
        window.open(printUrl, '_blank');
    }

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

        const skpiModalEl = document.getElementById('skpiActionModal');
        const openSkpiBtn = document.getElementById('openSkpiModal');

        if (skpiModalEl && openSkpiBtn) {
            const skpiModal = new bootstrap.Modal(skpiModalEl);

            openSkpiBtn.addEventListener('click', () => {
                skpiModal.show();
            });
        }

        // Validasi form import SKPI
        const formImportSkpi = document.getElementById('formImportSkpi');
        if (formImportSkpi) {
            formImportSkpi.addEventListener('submit', function(e) {
                const fileInput = this.querySelector('input[type="file"]');
                const file = fileInput?.files[0];

                if (!file) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'File belum dipilih',
                        text: 'Silakan pilih file CSV / Excel terlebih dahulu',
                        confirmButtonColor: '#980517'
                    });
                }
            });
        }

    });
</script>
@endpush

<!-- SweetAlert Notif -->
@if(session('success_swal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil 🎉',
            text: '{{ session('
            success_swal ') }}',
            confirmButtonText: 'OK',
            confirmButtonColor: '#980517'
        });
    });
</script>
@endif

@if(session('error_swal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal ❌',
            text: '{{ session('
            error_swal ') }}',
            confirmButtonText: 'OK',
            confirmButtonColor: '#980517'
        });
    });
</script>
@endif


@endsection