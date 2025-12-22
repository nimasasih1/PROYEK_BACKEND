@extends('layouts.dashboard')

@section('content')

<style>
    /* Badge Status */
    .badge-selesai {
        background: linear-gradient(120deg, #ffffff, #f3f3f3);
        color: #444;
        border: 1px solid #dcdcdc;
        padding: 6px 14px;
        border-radius: 12px;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Card Wrapper */
    .card-custom {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    /* Dropdown Catatan */
    .dropdown-menu-custom {
        border-radius: 12px !important;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
        border: none;
        background: #ffffff;
    }

    .dropdown-menu-custom li strong {
        color: #980517;
    }

    /* Tombol Catatan */
    .btn-catatan {
        background: #ffffff;
        border: 1px solid #dadada;
        transition: 0.2s;
    }

    .btn-catatan:hover {
        background: #f8f8f8;
        border-color: #c7c7c7;
    }

    /* Table */
    table.dataTable thead th {
        background: #980517 !important;
        color: white !important;
        text-align: center;
    }

    table.dataTable tbody tr:hover {
        background-color: #f7f7f7 !important;
    }
</style>

<div class="container-fluid">

    <div class="card-custom">
        <h2 class="mb-4" style="color:#980517; font-weight:700;">Rekap Selesai daftar Wisuda</h2>

        <div class="table-responsive" style="overflow-x: auto;">
            <table id="wisudaSelesaiTable" class="table table-striped table-hover table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Fakultas</th>
                        <th>Prodi</th>
                        <th>Tahun</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data ?? collect()->unique('id_pendaftaran') as $pendaftaran)
                    @if($pendaftaran->toga && $pendaftaran->toga->status_list == 1)
                    <tr style="text-align: center; vertical-align: middle;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pendaftaran->mahasiswa->nama_mahasiswa }}</td>
                        <td>{{ $pendaftaran->mahasiswa->nim }}</td>
                        <td>{{ $pendaftaran->mahasiswa->fakultas }}</td>
                        <td>{{ $pendaftaran->mahasiswa->prodi }}</td>
                        <td>{{ $pendaftaran->mahasiswa->tahun }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>


            </table>
        </div>
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
    });
</script>
@endpush