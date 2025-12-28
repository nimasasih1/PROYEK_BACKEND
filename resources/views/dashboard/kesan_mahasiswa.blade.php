@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .faq-wrapper {
        max-width: 900px;
        margin: auto;
    }

    .faq-item {
        background: #fff;
        border: 1px solid #e1e5eb;
        border-radius: 12px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        position: relative;
    }

    .faq-item:hover {
        border-color: #696cff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .faq-question {
        padding: 18px 20px;
        background: #f8f9fa;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        border-radius: 12px;
    }

    .faq-title {
        font-weight: 600;
        color: #566a7f;
        flex-grow: 1;
        display: flex;
        align-items: center;
    }

    .faq-controls {
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        z-index: 10;
    }

    .faq-answer {
        padding: 20px;
        display: none;
        border-top: 1px solid #e1e5eb;
        background: #ffffff;
        color: #697a8d;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .icon-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: 0.2s;
        background: transparent;
        cursor: pointer;
        border: 1px solid;
    }

    .btn-edit {
        border-color: #ffab00;
        color: #ffab00;
    }

    .btn-edit:hover {
        background: #ffab00;
        color: #fff;
    }

    .btn-delete {
        border-color: #ff3e1d;
        color: #ff3e1d;
    }

    .btn-delete:hover {
        background: #ff3e1d;
        color: #fff;
    }

    .status-btn {
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0 12px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .badge-status {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }
</style>

<div class="container faq-wrapper mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><i class="bi bi-chat-left-text me-2 text-primary"></i>Kesan & Pesan Mahasiswa</h4>
    </div>

    <div class="modal fade" id="kesanModal" tabindex="-1" aria-labelledby="formTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title text-primary" id="formTitle">Tulis Kesan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="mainForm" action="{{ route('kesan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Mahasiswa</label>
                                <input type="text" name="nama" id="input_nama" class="form-control bg-light"
                                    value="{{ $mahasiswa->nama_mahasiswa ?? Auth::user()->name }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal</label>
                                <input type="date" name="tanggal" id="input_tanggal" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kesan & Pesan</label>
                            <textarea name="kesan" id="input_kesan" class="form-control" rows="5"
                                placeholder="Ceritakan pengalaman berkesan Anda..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Simpan Kesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @forelse($kesan as $k)
    <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq({{ $k->id }})">
            <div class="faq-title">
                <span class="badge-status {{ $k->status == 1 ? 'bg-success' : 'bg-secondary' }} me-3"></span>
                Bagaimana kesan dari <strong class="ms-1">{{ $k->nama }}</strong>?
            </div>

            <div class="faq-controls">
<<<<<<< HEAD
                {{-- FIX: Pakai URL langsung, lebih aman --}}
                <form action="{{ url('/dashboard/kesan-mahasiswa/' . $k->id . '/toggle') }}" method="POST" class="d-inline">
=======
                <form action="{{ route('kesan.toggle', $k->id) }}" method="POST" class="d-inline">
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn status-btn {{ $k->status == 1 ? 'btn-outline-secondary' : 'btn-outline-success' }}"
                        onclick="confirmStatus(event, this.form, {{ $k->status }})">
                        <i class="bi {{ $k->status == 1 ? 'bi-eye-slash' : 'bi-send' }}"></i>
                        {{ $k->status == 1 ? 'Draft' : 'Publish' }}
                    </button>
                </form>

                <button type="button"
                    class="icon-btn btn-edit-kesan"
                    data-id="{{ $k->id }}"
                    data-nama="{{ $k->nama }}"
                    data-tanggal="{{ \Carbon\Carbon::parse($k->tanggal)->format('Y-m-d') }}"
                    data-kesan="{{ $k->kesan }}"
                    data-bs-toggle="modal"
                    data-bs-target="#editKesanModal">
                    <i class="bi bi-pencil"></i>
                </button>

<<<<<<< HEAD
                {{-- FIX: Pakai URL langsung untuk delete juga --}}
                <form action="{{ url('/dashboard/kesan-mahasiswa/' . $k->id) }}" method="POST" class="d-inline">
=======
                <form action="{{ route('kesan.destroy', $k->id) }}" method="POST" class="d-inline">
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
                    @csrf
                    @method('DELETE')
                    <button type="button" class="icon-btn btn-delete"
                        onclick="confirmDelete(event, this.form)" title="Hapus">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>

                <i class='bi bi-chevron-down ms-2 text-muted transition-icon' id="icon-{{ $k->id }}"></i>
            </div>
        </div>

        <div class="faq-answer" id="answer-{{ $k->id }}">
            <div class="d-flex">
                <i class="bi bi-quote text-primary fs-3 me-3 opacity-25"></i>
                <div class="flex-grow-1">
                    <p class="mb-3 text-dark" style="font-style: italic; font-size: 1.05rem;">
                        "{{ $k->kesan }}"
                    </p>
                    <div class="d-flex justify-content-between align-items-center border-top pt-2">
                        <span class="badge bg-light text-primary">Mahasiswa</span>
                        <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-5">
        <i class="bi bi-chat-square-quote fs-1 text-muted opacity-25"></i>
        <p class="mt-2 text-muted">Belum ada kesan dan pesan yang ditulis.</p>
    </div>
    @endforelse
</div>

{{-- Modal Edit Kesan --}}
<div class="modal fade" id="editKesanModal" tabindex="-1" aria-labelledby="editKesanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="editKesanForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title text-primary" id="editKesanLabel">
                        <i class="bi bi-pencil-square me-2"></i>Edit Kesan Mahasiswa
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Mahasiswa</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control bg-light" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kesan & Pesan</label>
                        <textarea name="kesan" id="edit_kesan" class="form-control" rows="5" required></textarea>
                    </div>

                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Kesan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Inisialisasi Modal
    const modalEl = document.getElementById('kesanModal');
    const bModal = new bootstrap.Modal(modalEl);

    function toggleFaq(id) {
        const answer = document.getElementById('answer-' + id);
        const icon = document.getElementById('icon-' + id);
        const isVisible = answer.style.display === "block";

        document.querySelectorAll('.faq-answer').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.bi-chevron-down').forEach(el => el.style.transform = "rotate(0deg)");

        if (!isVisible) {
            answer.style.display = "block";
            icon.style.transform = "rotate(180deg)";
        }
    }

    function confirmDelete(event, form) {
        event.stopPropagation();
        Swal.fire({
            title: 'Hapus data?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff3e1d',
            cancelButtonColor: '#8592a3',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    }

    function confirmStatus(event, form, currentStatus) {
        event.stopPropagation();
        const text = currentStatus == 1 ? 'Kesan akan disembunyikan (Draft)' : 'Kesan akan ditampilkan ke publik (Publish)';
        Swal.fire({
            title: 'Ubah Status?',
            text: text,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: currentStatus == 1 ? '#8592a3' : '#71dd37',
            cancelButtonColor: '#e1e5eb',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    }

    function showAddForm() {
        document.getElementById('formTitle').innerHTML = '<i class="bi bi-plus-circle me-2"></i>Tulis Kesan Baru';
        document.getElementById('mainForm').action = "{{ route('kesan.store') }}";
        document.getElementById('formMethod').value = "POST";
        document.getElementById('submitBtn').innerText = 'Simpan Kesan';
        document.getElementById('input_kesan').value = '';
        bModal.show();
    }

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 2500,
        showConfirmButton: false
    });
    @endif

    $(document).ready(function() {
        var editModal = new bootstrap.Modal(document.getElementById('editKesanModal'));

        $(document).on('click', '.btn-edit-kesan', function() {
            let btn = $(this);
            // Mengisi input modal
            $('#edit_nama').val(btn.data('nama'));
            $('#edit_tanggal').val(btn.data('tanggal'));
            $('#edit_kesan').val(btn.data('kesan'));
<<<<<<< HEAD
            // Mengatur action form - FIX: pakai URL langsung
=======
            // Mengatur action form
>>>>>>> 5a9dfefd4a1c4645d1b8cba01f9acf03691b6b91
            $('#editKesanForm').attr('action', '/dashboard/kesan-mahasiswa/' + btn.data('id'));
            // Tampilkan modal
            editModal.show();
        });
    });
</script>
@endsection