@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">

<style>
    .icon-btn {
        border: 1px solid #dc3545 !important;
        color: #dc3545 !important;
        background: transparent !important;
        padding: 4px 8px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .icon-btn i {
        font-size: 16px;
    }
    .action-buttons {
        display: flex;
        gap: 6px;
    }
    thead th {
        color: #000 !important;
    }
</style>

<div class="card">
    <h5 class="card-header" title="Daftar Syarat & Ketentuan">Graduation Requirements List</h5>

    <div class="px-3 mt-2">
        <button class="btn btn-primary mb-3" onclick="showAddForm()" title="Tambah Syarat baru">+ Add Requirement</button>
    </div>

    @if(session('success'))
    <div class="alert alert-success mx-3">{{ session('success') }}</div>
    @endif

    <div class="table-responsive text-nowrap px-3 mb-3">
        <table id="syaratTable" class="table table-bordered">
            <thead>
                <tr>
                    <th title="Nomor Urut">Order</th>
                    <th title="Judul">Judul</th>
                    <th title="Deskripsi">Deskripsi</th>
                    <th title="Ikon">Ikon</th>
                    <th title="Aksi">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($syarat as $s)
                <tr>
                    <td>{{ $s->order_number }}</td>
                    <td><strong>{{ $s->title_id }}</strong></td>
                    <td style="white-space: normal; min-width: 300px;">
                        {{ Str::limit($s->description_id, 150) }}
                    </td>
                    <td><i class="bi {{ $s->icon }}"></i></td>
                    <td class="action-buttons">
                        <button type="button" class="icon-btn" onclick="editSyarat({{ $s->id }})" title="Ubah data ini">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <form action="{{ route('syarat.destroy', $s->id) }}" method="POST" class="d-inline delete-syarat-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="icon-btn text-danger btn-delete-syarat" title="Hapus data ini">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- FORM TAMBAH --}}
<div id="addForm" class="card mt-4" style="display:none;">
    <h5 class="card-header">Add Graduation Requirement</h5>
    <div class="card-body">
        <form action="{{ route('syarat.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Order (No Urut)</label>
                    <input type="number" name="order_number" class="form-control" required>
                </div>
                <div class="col-md-9 mb-3">
                    <label class="form-label">Judul (Title)</label>
                    <input type="text" name="title_id" class="form-control" placeholder="Contoh: Nilai Akademik Lengkap" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi (Description)</label>
                <textarea name="description_id" class="form-control" rows="3" placeholder="Contoh: Seluruh mata kuliah telah tuntas dengan nilai lengkap..." required></textarea>
            </div>
            
            {{-- Hidden fields to maintain "automatic" functionality --}}
            <input type="hidden" name="title_en" value="-">
            <input type="hidden" name="description_en" value="-">
            <input type="hidden" name="icon" value="bi-check2-square">
            <input type="hidden" name="color" value="#6c757d">

            <button class="btn btn-primary">Save Requirement</button>
            <button type="button" class="btn btn-secondary" onclick="hideForms()">Cancel</button>
        </form>
    </div>
</div>

{{-- FORM EDIT --}}
<div id="editForm" class="card mt-4" style="display:none;">
    <h5 class="card-header">Edit Graduation Requirement</h5>
    <div class="card-body">
        <form id="editSyaratForm" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Order (No Urut)</label>
                    <input type="number" id="edit_order_number" name="order_number" class="form-control" required>
                </div>
                <div class="col-md-9 mb-3">
                    <label class="form-label">Judul (Title)</label>
                    <input type="text" id="edit_title_id" name="title_id" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi (Description)</label>
                <textarea id="edit_description_id" name="description_id" class="form-control" rows="3" required></textarea>
            </div>

            {{-- Hidden fields to preserve existing values if they are not in form --}}
            <input type="hidden" id="edit_title_en" name="title_en">
            <input type="hidden" id="edit_description_en" name="description_en">
            <input type="hidden" id="edit_icon" name="icon">
            <input type="hidden" id="edit_color" name="color">

            <button class="btn btn-primary">Update Requirement</button>
            <button type="button" class="btn btn-secondary" onclick="hideForms()">Cancel</button>
        </form>
    </div>
</div>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showAddForm() {
        document.getElementById('addForm').style.display = 'block';
        document.getElementById('editForm').style.display = 'none';
        window.scrollTo(0, document.getElementById('addForm').offsetTop);
    }

    function hideForms() {
        document.getElementById('addForm').style.display = 'none';
        document.getElementById('editForm').style.display = 'none';
    }

    function editSyarat(id) {
        fetch('/dashboard/syarat/' + id)
            .then(res => res.json())
            .then(data => {
                document.getElementById('editForm').style.display = 'block';
                document.getElementById('addForm').style.display = 'none';

                document.getElementById('edit_order_number').value = data.order_number;
                document.getElementById('edit_title_en').value = data.title_en;
                document.getElementById('edit_title_id').value = data.title_id;
                document.getElementById('edit_description_en').value = data.description_en;
                document.getElementById('edit_description_id').value = data.description_id;
                document.getElementById('edit_icon').value = data.icon;
                document.getElementById('edit_color').value = data.color;

                document.getElementById('editSyaratForm').action = '/dashboard/syarat/' + id;
                window.scrollTo(0, document.getElementById('editForm').offsetTop);
            });
    }

    // DataTable
    document.addEventListener("DOMContentLoaded", function() {
        const table = new DataTable('#syaratTable', {
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                zeroRecords: "No data found",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "No entries available",
                infoFiltered: "(filtered from _MAX_ total entries)"
            }
        });

        // Delete with SweetAlert
        document.querySelectorAll('.btn-delete-syarat').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = btn.closest('.delete-syarat-form');
                Swal.fire({
                    title: 'Are you sure you want to delete?',
                    text: "This data will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#980517',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: 'Cancel'
                }).then(result => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    });
</script>

{{-- SweetAlert Sessions --}}
@if(session('success_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon: 'success', title: 'Success!', text: 'Requirement successfully saved.', confirmButtonText: 'OK', confirmButtonColor: '#980517' });
  });
</script>
@endif

@if(session('success1_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon: 'success', title: 'Success!', text: 'Requirement successfully updated.', confirmButtonText: 'OK', confirmButtonColor: '#980517' });
  });
</script>
@endif

@if(session('success2_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon: 'success', title: 'Success!', text: 'Requirement successfully deleted.', confirmButtonText: 'OK', confirmButtonColor: '#980517' });
  });
</script>
@endif

@endsection
