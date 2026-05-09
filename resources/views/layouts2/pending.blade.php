<!--halaman pending-->

@extends('layouts2.dashboard')
@include('modals.daftar_wisuda1')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <h2 class="mb-4" style="color: #8B0000; font-weight: 600;" title="Data Wisuda - Menunggu Validasi">Graduation Data — Pending Validation</h2>

    @php
        $totalMahasiswa = $data->count();
        $belumCeklis = $data->where('is_valid_finance', 0)->count();
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <span style="color: #6c757d; margin-right: 10px;" title="Tampilkan">Show</span>
            <select class="form-select d-inline-block" style="width: auto; padding: 5px 30px 5px 10px;" id="entriesPerPage">
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span style="color: #6c757d; margin-left: 10px;" title="data">entries</span>
        </div>
        <div class="d-flex align-items-center">
            <label for="searchInput" style="color: #6c757d; margin-right: 10px;" title="Cari">Search:</label>
            <input type="text" class="form-control" id="searchInput" style="width: 250px;">
        </div>
    </div>

    <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
        <table id="wisudaPendingTable" class="table table-bordered" style="width:100%; border-collapse: collapse;">
            <thead style="background-color: #8B0000;">
                <tr>
                    <th style="color:white;padding:12px 15px;text-align:center;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Nomor">NO</th>
                    <th style="color:white;padding:12px 15px;text-align:left;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Nama Mahasiswa">STUDENT NAME</th>
                    <th style="color:white;padding:12px 15px;text-align:left;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Nomor Induk Mahasiswa">STUDENT ID</th>
                    <th style="color:white;padding:12px 15px;text-align:left;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Fakultas">FACULTY</th>
                    <th style="color:white;padding:12px 15px;text-align:left;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Program Studi">STUDY PROGRAM</th>
                    <th style="color:white;padding:12px 15px;text-align:center;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Tahun Angkatan">BATCH</th>
                    <th style="color:white;padding:12px 15px;text-align:left;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Tanggal Pendaftaran">REG. DATE</th>
                    <th style="color:white;padding:12px 15px;text-align:left;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Ukuran Toga">GOWN SIZE</th>
                    <th style="color:white;padding:12px 15px;text-align:left;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Catatan Toga">GOWN NOTES</th>
                    <th style="color:white;padding:12px 15px;text-align:center;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Validasi Keuangan">FINANCE</th>
                    <th style="color:white;padding:12px 15px;text-align:center;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Catatan Keuangan">FINANCE NOTES</th>
                    <th style="color:white;padding:12px 15px;text-align:center;font-weight:600;border:1px solid #8B0000;white-space:nowrap;" title="Status Validasi">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->unique('id_pendaftaran') as $pendaftaran)
                    @if(!$pendaftaran->is_valid_finance)
                    <tr style="background-color: white;">
                        <td style="text-align:center;padding:15px;border:1px solid #dee2e6;">{{ $loop->iteration }}</td>
                        <td style="padding:15px;border:1px solid #dee2e6;">{{ $pendaftaran->mahasiswa->nama_mahasiswa }}</td>
                        <td style="padding:15px;border:1px solid #dee2e6;">{{ $pendaftaran->mahasiswa->nim }}</td>
                        <td style="padding:15px;border:1px solid #dee2e6;">{{ $pendaftaran->mahasiswa->fakultas }}</td>
                        <td style="padding:15px;border:1px solid #dee2e6;">{{ $pendaftaran->mahasiswa->prodi }}</td>
                        <td style="text-align:center;padding:15px;border:1px solid #dee2e6;">{{ $pendaftaran->mahasiswa->tahun }}</td>
                        <td style="padding:15px;border:1px solid #dee2e6;">{{ $pendaftaran->tgl_pendaftaran ?? '-' }}</td>
                        <td style="padding:15px;border:1px solid #dee2e6;">{{ $pendaftaran->toga->ukuran ?? '-' }}</td>
                        <td style="padding:15px;border:1px solid #dee2e6;">{{ $pendaftaran->toga->catatan ?? '-' }}</td>

                        <td style="text-align:center;padding:15px;border:1px solid #dee2e6;">
                            <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="field" value="is_valid_finance">
                                <input type="checkbox" name="is_valid_finance" value="1"
                                    {{ $pendaftaran->is_valid_finance ? 'checked' : '' }}
                                    title="Centang untuk validasi keuangan"
                                    style="width:18px;height:18px;cursor:pointer;">
                            </form>
                        </td>

                        <td style="padding:15px;border:1px solid #dee2e6;">
                            <form action="{{ route('layouts2.validation_finance.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex align-items-start gap-2" style="width:500px;">
                                @csrf @method('PUT')
                                <input type="hidden" name="field" value="catatan_finance">
                                <textarea name="catatan_finance" class="form-control" rows="2"
                                    placeholder="Write finance notes..."
                                    title="Tulis catatan keuangan"
                                    style="flex:2;min-width:350px;">{{ $pendaftaran->catatan_finance ?? '' }}</textarea>
                                <div class="d-flex flex-column gap-1">
                                    <button type="submit" class="btn btn-sm" title="Kirim catatan"
                                        style="background-color:white;border:1px solid #dee2e6;color:#8B0000;">
                                        <i class="bi bi-send-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}"
                                        title="Lihat catatan"
                                        style="background-color:white;border:1px solid #dee2e6;color:#8B0000;">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                            </form>

                            <div class="modal fade" id="catatanFinanceModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('layouts2.validation_finance.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="field" value="catatan_finance">
                                            <div class="modal-header">
                                                <h5 class="modal-title" title="Catatan Keuangan">Finance Notes</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" title="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea name="catatan_finance" class="form-control" rows="5" title="Tulis catatan keuangan">{{ $pendaftaran->catatan_finance ?? '' }}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Tutup modal">Close</button>
                                                <button type="submit" class="btn btn-primary" title="Simpan catatan">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td style="text-align:center;padding:15px;border:1px solid #dee2e6;">
                            <span class="badge" title="Menunggu validasi keuangan"
                                style="background-color:#fff3cd;color:#856404;padding:8px 16px;border-radius:20px;font-weight:500;">
                                WAITING
                            </span>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div style="color: #6c757d;" title="Informasi halaman">Page 1 of 1</div>
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" style="color:#6c757d;" title="Sebelumnya">←</a></li>
                <li class="page-item active"><a class="page-link" href="#" style="background-color:#8B0000;border-color:#8B0000;">1</a></li>
                <li class="page-item disabled"><a class="page-link" href="#" style="color:#6c757d;" title="Selanjutnya">→</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        var table = $('#wisudaPendingTable').DataTable({
            scrollX: true, autoWidth: false, responsive: false,
            searching: true, paging: true, pageLength: 10, info: false,
            dom: 't',
            language: {
                search: "", lengthMenu: "",
                zeroRecords: "No data found",
                paginate: { first: "First", last: "Last", next: "→", previous: "←" }
            }
        });

        $('#searchInput').on('keyup input', function() { table.search($(this).val()).draw(); });
        $('#entriesPerPage').on('change', function() { table.page.len($(this).val()).draw(); });

        $(document).on('change', 'input[name="is_valid_finance"]', function(e) {
            var $checkbox = $(this);
            var $row = $checkbox.closest('tr');
            var catatan = $row.find('textarea[name="catatan_finance"]').val().trim();
            if (catatan === '') {
                e.preventDefault();
                $checkbox.prop('checked', false);
                alert('⚠️ Please fill in the finance notes before validating!');
                return false;
            }
            $checkbox.closest('form').submit();
        });
    });
</script>
@endpush