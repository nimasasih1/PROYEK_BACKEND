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
    <h5 class="card-header" title="Daftar Pertanyaan dan Jawaban">Q &amp; A List</h5>

    <div class="px-3 mt-2">
        <button class="btn btn-primary mb-3" onclick="showAddForm()" title="Tambah QnA baru">+ Add Q&amp;A</button>
    </div>

    @if(session('success'))
    <div class="alert alert-success mx-3">{{ session('success') }}</div>
    @endif

    <div class="table-responsive text-nowrap px-3 mb-3">
        <table id="qnaTable" class="table table-bordered">
            <thead>
                <tr>
                    <th title="Nomor ID">ID</th>
                    <th title="Pertanyaan yang Diajukan" data-bs-toggle="tooltip">Question</th>
                    <th title="Jawaban atas Pertanyaan" data-bs-toggle="tooltip">Answer</th>
                    <th title="Aksi">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($qna as $q)
                <tr>
                    <td>{{ $q->id_qna }}</td>
                    <td>{{ $q->pertanyaan }}</td>
                    <td>{{ $q->jawaban }}</td>
                    <td class="action-buttons">
                        <button type="button" class="icon-btn edit-btn-skpi" onclick="editQna({{ $q->id_qna }})" title="Ubah data QnA ini">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <form action="{{ route('qna.delete', $q->id_qna) }}" method="POST" class="d-inline delete-qna-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="icon-btn text-danger btn-delete-qna" title="Hapus data QnA ini">
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
    <h5 class="card-header" title="Tambah Pertanyaan dan Jawaban Baru">Add Q &amp; A</h5>

    <div class="card-body">
        <form id="addQnaForm" action="{{ route('qna.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label" title="Tulis pertanyaan">Question</label>
                <input type="text" name="pertanyaan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label" title="Tulis jawaban dari pertanyaan">Answer</label>
                <textarea name="jawaban" class="form-control" rows="3" required></textarea>
            </div>

            <button class="btn btn-primary" title="Simpan QnA baru">Save</button>
        </form>
    </div>
</div>

{{-- FORM EDIT --}}
<div id="editForm" class="card mt-4" style="display:none;">
    <h5 class="card-header" title="Edit Pertanyaan dan Jawaban">Edit Q &amp; A</h5>

    <div class="card-body">
        <form id="editQnaForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" title="Ubah pertanyaan">Question</label>
                <input type="text" id="edit_pertanyaan" name="pertanyaan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label" title="Ubah jawaban">Answer</label>
                <textarea id="edit_jawaban" name="jawaban" class="form-control" rows="3" required></textarea>
            </div>

            <button class="btn btn-primary" title="Simpan perubahan QnA">Update</button>
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
    }

    function editQna(id) {
        fetch('/dashboard/qna/' + id)
            .then(res => res.json())
            .then(data => {
                document.getElementById('editForm').style.display = 'block';
                document.getElementById('addForm').style.display = 'none';

                document.getElementById('edit_pertanyaan').value = data.pertanyaan;
                document.getElementById('edit_jawaban').value = data.jawaban;

                document.getElementById('editQnaForm').action = '/dashboard/qna/' + id;
            });
    }

    // DataTable
    document.addEventListener("DOMContentLoaded", function() {
        const table = new DataTable('#qnaTable', {
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

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"], [title]'));
        tooltipTriggerList.map(function(el) {
            return new bootstrap.Tooltip(el, { trigger: 'hover', placement: 'top' });
        });

        // Delete QnA dengan SweetAlert
        document.querySelectorAll('.btn-delete-qna').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = btn.closest('.delete-qna-form');
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

{{-- SweetAlert Session --}}
@if(session('success_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '1 data successfully saved.',
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
      title: 'Success!',
      text: '1 data successfully updated.',
      confirmButtonText: 'OK',
      confirmButtonColor: '#980517'
    });
  });
</script>
@endif

@if(session('success2_swal'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '1 data successfully deleted.',
      confirmButtonText: 'OK',
      confirmButtonColor: '#980517'
    });
  });
</script>
@endif

@endsection