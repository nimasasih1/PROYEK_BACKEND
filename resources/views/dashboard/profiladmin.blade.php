@extends('layouts.dashboard')

@section('content')

<style>
    body {
        background-color: #f8f9fa;
    }

    /* Card Profil */
    .card-profil-admin {
        max-width: 480px;
        margin: 60px auto;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background: linear-gradient(135deg, #ffffff, #f0f0f0);
        transition: transform 0.3s;
    }

    .card-profil-admin:hover {
        transform: translateY(-5px);
    }

    .card-profil-admin img {
        border-radius: 50%;
        width: 130px;
        height: 130px;
        border: 4px solid #980517;
        transition: transform 0.3s;
    }

    .card-profil-admin img:hover {
        transform: scale(1.05);
    }

    .card-body {
        padding: 30px 20px;
    }

    h4 {
        font-weight: 700;
        color: #333;
    }

    p.text-muted {
        font-size: 0.95rem;
        margin-bottom: 25px;
    }

    /* Tombol Profil */
    .btn-profil {
        width: 100%;
        margin-bottom: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 10px;
        transition: 0.3s;
    }

    .btn-profil i {
        font-size: 16px;
    }

    .btn-outline-primary {
        color: #980517;
        border-color: #980517;
    }

    .btn-outline-primary:hover {
        background-color: #980517;
        color: white;
    }

    .btn-outline-danger {
        color: #c82333;
        border-color: #c82333;
    }

    .btn-outline-danger:hover {
        background-color: #c82333;
        color: white;
    }

    /* Untuk menampilkan error validation di modal */
    .is-invalid {
        border-color: #dc3545;
    }
</style>

<div class="container py-4">
    <div class="card card-profil-admin text-center">
        <div class="card-body">
            {{-- Foto Profil --}}
            <div class="mb-3">
                <img src="{{ $admin->foto ? asset($admin->foto) : asset('assets/img/avatars/1.png') }}" 
     alt="Foto Admin"
     style="object-fit:cover; width:130px; height:130px; border-radius:50%; border:4px solid #980517;">
            </div>

            

            {{-- Nama & Email --}}
            <h4>{{ $admin->name }}</h4>
            <p class="text-muted">{{ $admin->email }}</p>

            {{-- Info Detail --}}
<div class="text-start mt-3 mb-4 px-2">
    <table class="table table-borderless table-sm">
        <!--<tr>
            <td class="text-muted" style="width:40%"><i class="bi bi-person me-2"></i>Nama</td>
            <td><strong>{{ $admin->name }}</strong></td>
        </tr>
        <tr>
            <td class="text-muted"><i class="bi bi-envelope me-2"></i>Email</td>
            <td><strong>{{ $admin->email }}</strong></td>
        </tr>-->
        <tr>
            <td class="text-muted"><i class="bi bi-shield me-2"></i><span title="Peran/Jabatan">Role</span></td>
            <td><strong>{{ $admin->role ?? 'Administrator' }}</strong></td>
        </tr>
        <tr>
            <td class="text-muted"><i class="bi bi-person-badge me-2"></i><span title="Nama Pengguna">Username</span></td>
            <td><strong>{{ $admin->username }}</strong></td>
        </tr>
        <tr>
            <td class="text-muted"><i class="bi bi-calendar me-2"></i><span title="Tanggal Bergabung">Joined</span></td>
            <td><strong>{{ \Carbon\Carbon::parse($admin->created_at)->format('d M Y') }}</strong></td>
        </tr>
    </table>
</div>

            <button type="button" class="btn btn-outline-primary btn-profil" data-bs-toggle="modal" data-bs-target="#editFotoModal" title="Ubah foto profil Anda">
                <i class="bi bi-camera"></i> Edit Profile Photo
            </button>

            <button type="button" class="btn btn-outline-danger btn-profil" data-bs-toggle="modal" data-bs-target="#gantiPasswordModal" title="Ganti kata sandi akun Anda">
                <i class="bi bi-key"></i> Change Password
            </button>
        </div>
    </div>
</div>

{{-- Modal Edit Foto Profil --}}
<div class="modal fade" id="editFotoModal" tabindex="-1" aria-labelledby="editFotoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.updateFoto') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFotoLabel" title="Edit Foto Profil">Edit Profile Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" required>
                    @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" title="Simpan foto profil baru"><i class="bi bi-save"></i> Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Batal dan tutup modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Ganti Password --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Modal Ganti Password --}}
<div class="modal fade" id="gantiPasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.updatePassword') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" title="Ganti Kata Sandi">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- Password Lama --}}
                    <div class="mb-3">
                        <label title="Masukkan password lama Anda">Current Password</label>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" value="{{ old('current_password') }}" required>
                        @if(!empty($passwordHint))
                        <small class="text-muted" title="Petunjuk: huruf terakhir password lama">Last character hint: <strong>{{ $passwordHint }}</strong></small>
                        @endif
                        @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-3">
                        <label title="Masukkan password baru Anda">New Password</label>
                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
                        @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-3">
                        <label title="Ulangi password baru untuk konfirmasi">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" title="Simpan password baru"><i class="bi bi-key-fill"></i> Change Password</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Auto buka modal jika ada error --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if($errors->any() || session('show_password_modal'))
        var myModal = new bootstrap.Modal(document.getElementById('gantiPasswordModal'));
        myModal.show();
        @endif
    });
</script>


@endsection