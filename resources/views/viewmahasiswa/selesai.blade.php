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
                        <th>Toga Selesai</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Fakultas</th>
                        <th>Prodi</th>
                        <th>Tahun</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Ukuran Toga</th>
                        <th>Catatan Toga</th>
                        <th>Keuangan</th>
                        <th>Perpus</th>
                        <th>Fakultas</th>
                        <th>BAAK</th>
                        <th>Catatan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data->unique('id_pendaftaran') as $pendaftaran)
                    @if($pendaftaran->is_valid_finance
                    && $pendaftaran->is_valid_perpus
                    && $pendaftaran->is_valid_fakultas
                    && $pendaftaran->is_valid_baak)

                    <tr style="text-align: center; vertical-align: middle;">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if(isset($pendaftaran->toga))
                            <input type="checkbox"
                                class="toggle-status-list"
                                data-id="{{ $pendaftaran->toga->id_pengambilan }}"
                                {{ $pendaftaran->toga->status_list == 1 | 0 ? 'checked' : '' }}>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $pendaftaran->mahasiswa->nama_mahasiswa }}</td>
                        <td>{{ $pendaftaran->mahasiswa->nim }}</td>
                        <td>{{ $pendaftaran->mahasiswa->fakultas }}</td>
                        <td>{{ $pendaftaran->mahasiswa->prodi }}</td>
                        <td>{{ $pendaftaran->mahasiswa->tahun }}</td>
                        <td>{{ $pendaftaran->tgl_pendaftaran ?? '-' }}</td>
                        <td>{{ $pendaftaran->toga->ukuran ?? '-' }}</td>
                        <td>{{ $pendaftaran->toga->catatan ?? '-' }}</td>

                        <td>✔</td>
                        <td>✔</td>
                        <td>✔</td>
                        <td>✔</td>

                        <td>
                            <!-- Tombol Lihat Catatan -->
                            <button class="btn btn-catatan btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#catatanModal{{ $pendaftaran->id_pendaftaran }}">
                                Lihat Catatan
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="catatanModal{{ $pendaftaran->id_pendaftaran }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content"
                                        style="border-radius:12px; overflow:visible; background:white; color:black; box-shadow:0 8px 25px rgba(0,0,0,0.15);">
                                        <!-- Header -->
                                        <div class="modal-header"
                                            style="background:white; color:black; border-bottom:none; border-top-left-radius:12px; border-top-right-radius:12px;">
                                            <h5 class="modal-title" style="font-weight:600;">Catatan {{ $pendaftaran->mahasiswa->nama_mahasiswa }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- Body -->
                                        <div class="modal-body" style="padding:20px; color:black; font-size:14px;">
                                            <table class="table table-striped table-bordered"
                                                style="background:white; color:black; border-radius:8px; overflow:hidden;">
                                                <thead style="background:white; color:black;">
                                                    <tr>
                                                        <th>Bagian</th>
                                                        <th>Catatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Fakultas</td>
                                                        <td>{{ $pendaftaran->catatan_fakultas ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keuangan</td>
                                                        <td>{{ $pendaftaran->catatan_finance ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Perpus</td>
                                                        <td>{{ $pendaftaran->catatan_perpus ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>BAAK</td>
                                                        <td>{{ $pendaftaran->catatan_baak ?? '-' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="badge badge-selesai">Selesai ✔</span>
                        </td>
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

    $(document).on('change', '.toggle-status-list', function() {
        let checkbox = $(this);
        let id = checkbox.data('id');
        let value = checkbox.is(':checked') ? 1 : 0;

        console.log("Mengupdate status list:", {
            id: id,
            value: value
        });

        // Validasi ID
        if (!id || id === undefined || id === null) {
            console.error("ID tidak valid:", id);
            alert("ID data tidak valid. Silakan refresh halaman.");
            checkbox.prop('checked', !checkbox.prop('checked')); // Kembalikan state
            return;
        }

        // Non-aktifkan checkbox sementara
        checkbox.prop('disabled', true);

        $.ajax({
            url: '/wisuda1/update-status-list/' + id,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                value: value
            },
            success: function(res) {
                console.log("Success:", res);
                // Tambahkan animasi visual feedback
                checkbox.closest('td').addClass('bg-success-subtle');
                setTimeout(() => {
                    checkbox.closest('td').removeClass('bg-success-subtle');
                }, 500);
            },
            error: function(err) {
                console.error("Error detail:", err);

                // Kembalikan ke state sebelumnya
                checkbox.prop('checked', !checkbox.prop('checked'));

                // Tampilkan pesan error yang lebih spesifik
                let errorMsg = "Gagal update status list. ";
                if (err.responseJSON && err.responseJSON.error) {
                    errorMsg += err.responseJSON.error;
                    if (err.responseJSON.debug_id) {
                        errorMsg += " (ID: " + err.responseJSON.debug_id + ")";
                    }
                } else {
                    errorMsg += "Periksa koneksi internet atau coba lagi.";
                }

                alert(errorMsg);

                // Tambahkan animasi error
                checkbox.closest('td').addClass('bg-danger-subtle');
                setTimeout(() => {
                    checkbox.closest('td').removeClass('bg-danger-subtle');
                }, 1000);
            },
            complete: function() {
                // Aktifkan kembali checkbox
                checkbox.prop('disabled', false);
            }
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
</script>
@endpush