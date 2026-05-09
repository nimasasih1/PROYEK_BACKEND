@extends('layouts3.dashboard')
@include('modals.daftar_wisuda1')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endpush

@section('content')
<div class="container-fluid">
    <h2 class="mb-4" style="color: #8B0000; font-weight: 600;" title="Data Wisuda - Selesai Divalidasi">Graduation Data - Validation Completed</h2>

    @php
        $sudahCeklis = $data->where('is_valid_perpus', 1)->count();
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
            <label for="searchInput" style="color: #6c757d; margin-right: 10px;" title="Cari:">Search:</label>
            <input type="text" class="form-control" id="searchInput" style="width: 250px;">
        </div>
    </div>

    <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
        <table id="wisudaSelesaiTable" class="table table-bordered" style="width:100%; border-collapse: collapse;">
            <thead style="background-color: #8B0000;">
                <tr>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="NO">NO</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="NAMA MAHASISWA">STUDENT NAME</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="NIM">STUDENT ID</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="FAKULTAS">FACULTY</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="PRODI">DEPARTMENT</th>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="TAHUN">YEAR</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="TANGGAL PENDAFTARAN">REGISTRATION DATE</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="UKURAN">SIZE</th>
                    <th style="color: white; padding: 12px 15px; text-align: left; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="CATATAN TOGA">GOWN NOTES</th>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="CATATAN PERPUSTAKAAN">LIBRARY NOTES</th>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="STATUS">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->unique('id_pendaftaran') as $pendaftaran)
                    @if($pendaftaran->is_valid_perpus)
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
                        <td style="padding: 15px; border: 1px solid #dee2e6;">{{ $pendaftaran->catatan_perpus ?? '-' }}</td>
                        <td style="text-align: center; padding: 15px; border: 1px solid #dee2e6;">
                            <span class="badge" title="Selesai divalidasi" style="background-color: #28a745; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 500;">
                                <i class="bi bi-check-circle me-1"></i> COMPLETED
                            </span>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div style="color: #6c757d;" title="Halaman 1 dari 1">Page 1 of 1</div>
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" style="color: #6c757d;">←</a></li>
                <li class="page-item active"><a class="page-link" href="#" style="background-color: #8B0000; border-color: #8B0000;">1</a></li>
                <li class="page-item disabled"><a class="page-link" href="#" style="color: #6c757d;">→</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        var table = $('#wisudaSelesaiTable').DataTable({
            scrollX: true, autoWidth: false, responsive: false,
            searching: true, paging: true, pageLength: 10, info: false, dom: 't',
            language: {
                search: "", lengthMenu: "",
                zeroRecords: "No matching records found",
                paginate: { first: "First", last: "Last", next: "→", previous: "←" }
            }
        });

        // ✅ Search berfungsi
        $('#searchInput').on('keyup input', function() {
            table.search($(this).val()).draw();
        });

        // ✅ Entries per page
        $('#entriesPerPage').on('change', function() {
            table.page.len($(this).val()).draw();
        });
    });
</script>
@endpush