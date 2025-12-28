@extends('layouts2.dashboard')
@include('modals.daftar_wisuda1')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endpush

@section('content')
<div class="container-fluid">
    <h2 class="mb-4" style="color: #8B0000; font-weight: 600;">Data Wisuda Pending</h2>

    @php
        $totalMahasiswa = $data->count();
        $sudahCeklis = $data->where('is_valid_finance', 1)->count();
        $belumCeklis = $totalMahasiswa - $sudahCeklis;
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <span style="color: #6c757d; margin-right: 10px;">Tampilkan</span>
            <select class="form-select d-inline-block" style="width: auto; padding: 5px 30px 5px 10px;" id="entriesPerPage">
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span style="color: #6c757d; margin-left: 10px;">data</span>
        </div>
        <div class="d-flex align-items-center">
            <label for="searchInput" style="color: #6c757d; margin-right: 10px;">Cari:</label>
            <input type="text" class="form-control" id="searchInput" style="width: 250px;">
        </div>
    </div>

    <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
        <table id="wisudaPendingTable" class="table table-bordered" style="width:100%; border-collapse: collapse;">
            <thead style="background-color: #8B0000;">
                <tr>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">NO</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">NAMA MAHASISWA</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">NIM</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">FAKULTAS</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">PRODI</th>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">TAHUN</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">TANGGAL PENDAFTARAN</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">UKURAN</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">CATATAN</th>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">KEUANGAN</th>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">CATATAN KEUANGAN</th>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->unique('id_pendaftaran') as $pendaftaran)
                    @if(!($pendaftaran->is_valid_finance && $pendaftaran->is_valid_perpus && $pendaftaran->is_valid_fakultas && $pendaftaran->is_valid_baak))
                    <tr style="background-color: white;">
                        <td style="text-align: center; padding: 15px; border: 1px solid #dee2e6;">{{ $loop->iteration }}</td>
                        <td style="padding: 15px; border: 1px solid #dee2e6;">{{ $pendaftaran->mahasiswa->nama_mahasiswa }}</td>
                        <td style="padding: 15px; border: 1px solid #dee2e6;">{{ $pendaftaran->mahasiswa->nim }}</td>
                        <td style="padding: 15px; border: 1px solid #dee2e6;">{{ $pendaftaran->mahasiswa->fakultas }}</td>
                        <td style="padding: 15px; border: 1px solid #dee2e6;">{{ $pendaftaran->mahasiswa->prodi }}</td>
                        <td style="text-align: center; padding: 15px; border: 1px solid #dee2e6;">{{ $pendaftaran->mahasiswa->tahun }}</td>
                        <td style="padding: 15px; border: 1px solid #dee2e6;">{{ $pendaftaran->tgl_pendaftaran ?? '-' }}</td>
                        <td style="padding: 15px; border: 1px solid #dee2e6;">{{ $pendaftaran->toga->ukuran ?? '-' }}</td>
                        <td style="padding: 15px; border: 1px solid #dee2e6;">{{ $pendaftaran->toga->catatan ?? '-' }}</td>

                        <!-- Checkbox Finance -->
                        <td style="text-align: center; padding: 15px; border: 1px solid #dee2e6;">
                            <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="field" value="is_valid_finance">
                                <input type="checkbox" name="is_valid_finance" value="1"
                                    onchange="this.form.submit()"
                                    {{ $pendaftaran->is_valid_finance ? 'checked' : '' }}
                                    style="width: 18px; height: 18px; cursor: pointer;">
                            </form>
                        </td>

                        <!-- Catatan Finance -->
                        <td style="padding: 15px; border: 1px solid #dee2e6;">
                            <form action="{{ route('layouts2.validation_finance.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex align-items-start gap-2" style="width: 500px;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="field" value="catatan_finance">

                                <textarea name="catatan_finance" class="form-control" rows="2" placeholder="Tulis catatan finance..." style="flex:2; min-width: 350px;">{{ $pendaftaran->catatan_finance ?? '' }}</textarea>

                                <div class="d-flex flex-column gap-1">
                                    <button type="submit" class="btn btn-sm" title="Kirim"
                                        style="background-color: white; border: 1px solid #dee2e6; color: #8B0000;">
                                        <i class="bi bi-send-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}" 
                                        title="Lihat"
                                        style="background-color: white; border: 1px solid #dee2e6; color: #8B0000;">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                            </form>

                            <!-- Modal Catatan Finance -->
                            <div class="modal fade" id="catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1" aria-labelledby="catatanFinanceLabel{{ $pendaftaran->id_pendaftaran }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('layouts2.validation_finance.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="field" value="catatan_finance">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="catatanFinanceLabel{{ $pendaftaran->id_pendaftaran }}">Catatan Keuangan</h5>
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

                        <td style="text-align: center; padding: 15px; border: 1px solid #dee2e6;">
                            <span class="badge" style="background-color: #e8e8e8; color: #666; padding: 8px 16px; border-radius: 20px; font-weight: 500;">MENUNGGU</span>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div style="color: #6c757d;">
            Halaman 1 dari 1
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" style="color: #6c757d;">←</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#" style="background-color: #8B0000; border-color: #8B0000;">1</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#" style="color: #6c757d;">→</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        var table = $('#wisudaPendingTable').DataTable({
            scrollX: true,
            autoWidth: false,
            responsive: false,
            searching: true,
            paging: true,
            pageLength: 10,
            info: false,
            dom: 't',
            language: {
                search: "",
                lengthMenu: "",
                zeroRecords: "Tidak ada data yang ditemukan",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "→",
                    previous: "←"
                }
            }
        });

        // Custom search
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Custom entries per page
        $('#entriesPerPage').on('change', function() {
            table.page.len(this.value).draw();
        });
    });
</script>
@endpush