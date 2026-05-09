@extends('layouts3.dashboard')
@include('modals.daftar_wisuda1')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endpush

@section('content')
<div class="container-fluid">
    <h2 class="mb-4" style="color: #8B0000; font-weight: 600;" title="Data Wisuda - Menunggu Validasi">Graduation Data - Awaiting Validation</h2>

    @php
        $belumCeklis = $data->where('is_valid_perpus', 0)->count();
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
        {{-- ✅ ID tabel disamakan: wisudaPendingTable --}}
        <table id="wisudaPendingTable" class="table table-bordered" style="width:100%; border-collapse: collapse;">
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
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="PERPUSTAKAAN">LIBRARY</th>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="CATATAN PERPUSTAKAAN">LIBRARY NOTES</th>
                    <th style="color: white; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #8B0000; white-space: nowrap;" title="STATUS">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->unique('id_pendaftaran') as $pendaftaran)
                    @if(!$pendaftaran->is_valid_perpus)
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

                        <!-- Checkbox Perpustakaan — ✅ HAPUS onchange dari sini -->
                        <td style="text-align: center; padding: 15px; border: 1px solid #dee2e6;">
                            <form action="{{ route('viewmahasiswa.wisuda1.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="field" value="is_valid_perpus">
                                <input type="checkbox" name="is_valid_perpus" value="1"
                                    {{ $pendaftaran->is_valid_perpus ? 'checked' : '' }}
                                    style="width: 18px; height: 18px; cursor: pointer;">
                            </form>
                        </td>

                        <!-- Catatan Perpustakaan -->
                        <td style="padding: 15px; border: 1px solid #dee2e6;">
                            <form action="{{ route('layouts3.validation_perpus.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="d-flex align-items-start gap-2" style="width: 500px;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="field" value="catatan_perpus">
                                <textarea name="catatan_perpus" class="form-control" rows="2" placeholder="Write library notes..." title="Tulis catatan perpustakaan..." style="flex:2; min-width: 350px;">{{ $pendaftaran->catatan_perpus ?? '' }}</textarea>
                                <div class="d-flex flex-column gap-1">
                                    <button type="submit" class="btn btn-sm" title="Kirim"
                                        style="background-color: white; border: 1px solid #dee2e6; color: #8B0000;">
                                        <i class="bi bi-send-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#catatanPerpusModal{{ $pendaftaran->id_pendaftaran }}"
                                        title="Lihat"
                                        style="background-color: white; border: 1px solid #dee2e6; color: #8B0000;">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                            </form>

                            <!-- Modal Catatan Perpustakaan -->
                            <div class="modal fade" id="catatanPerpusModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('layouts3.validation_perpus.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="field" value="catatan_perpus">
                                            <div class="modal-header">
                                                <h5 class="modal-title" title="Catatan Perpustakaan">Library Notes</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea name="catatan_perpus" class="form-control" rows="5">{{ $pendaftaran->catatan_perpus ?? '' }}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Tutup">Close</button>
                                                <button type="submit" class="btn btn-primary" title="Simpan">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td style="text-align: center; padding: 15px; border: 1px solid #dee2e6;">
                            <span class="badge" title="Menunggu validasi" style="background-color: #fff3cd; color: #856404; padding: 8px 16px; border-radius: 20px; font-weight: 500;">PENDING</span>
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
        var table = $('#wisudaPendingTable').DataTable({
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

        // ✅ Cegah checkbox kalau catatan perpus belum diisi
        $(document).on('change', 'input[name="is_valid_perpus"]', function(e) {
            var $checkbox = $(this);
            var $row = $checkbox.closest('tr');
            var catatan = $row.find('textarea[name="catatan_perpus"]').val().trim();

            if (catatan === '') {
                e.preventDefault();
                $checkbox.prop('checked', false);
                alert('⚠️ Please fill in the library notes before validating!');
                return false;
            }

            $checkbox.closest('form').submit();
        });
    });
</script>
@endpush