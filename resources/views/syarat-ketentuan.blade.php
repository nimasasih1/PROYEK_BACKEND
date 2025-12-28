<!-- resources/views/syarat-ketentuan.blade.php -->
@extends('base.header')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Section -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center py-5"
     style="background: linear-gradient(135deg, #980517 0%, #d4142a 50%, #ff4b5c 100%);">

                    <h1 class="text-white mb-3">
                        <i class="bi bi-mortarboard-fill me-2"></i>
                        Syarat & Ketentuan Kelulusan Wisuda
                    </h1>
                    <p class="text-white-50 mb-0">Pastikan Anda memenuhi semua persyaratan berikut sebelum mendaftar wisuda</p>
                </div>
            </div>

            <!-- Main Content -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="alert alert-info border-0" role="alert">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <strong>Perhatian!</strong> Seluruh persyaratan di bawah ini wajib dipenuhi untuk dapat mengikuti wisuda.
                    </div>

                    <!-- Persyaratan List -->
                    <div class="mt-4 text-gray">
    <h4 class="mb-4 fw-semibold">
        <i class="bi bi-check2-square me-2"></i>
        Persyaratan Kelulusan Wisuda
    </h4>

                        <!-- Item 1 -->
                        <div class="card mb-3 border-start border-4" style="border-color:#adb5bd;">
    <div class="card-body">
        <div class="d-flex align-items-start">
            <div class="badge rounded-circle p-2 me-3"
                 style="width:40px;height:40px;
                        display:flex;align-items:center;justify-content:center;
                        background-color:#6c757d;color:#ffffff;">
                <strong>1</strong>
            </div>

            <div class="flex-grow-1">
                <h5 class="card-title mb-2">
                    <i class="bi bi-graph-up me-2" style="color:#6c757d;"></i>
                    Nilai Akademik Lengkap
                </h5>
                <p class="card-text text-muted mb-0">
                    Seluruh mata kuliah telah tuntas dengan nilai lengkap dan tidak ada nilai kosong atau incomplete (I). Pastikan semua SKS telah terpenuhi sesuai kurikulum program studi.
                </p>
            </div>
        </div>
    </div>
</div>


                        <!-- Item 2 -->
                        <div class="card mb-3 border-start border-4" style="border-color:#adb5bd;">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="badge rounded-circle p-2 me-3"
                 style="width:40px;height:40px;
                        display:flex;align-items:center;justify-content:center;
                        background-color:#6c757d;color:#ffffff;">
                <strong>2</strong>
            </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-2">
                                            <i class="bi bi-cash-coin me-2" style="color:#6c757d;"></i>
                                            Pembayaran Lunas
                                        </h5>
                                        <p class="card-text text-muted mb-0">
                                            Seluruh biaya pendidikan termasuk SPP, biaya wisuda, dan administrasi lainnya telah diselesaikan. Tidak ada tunggakan pembayaran yang masih tersisa.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="card mb-3 border-start border-4" style="border-color:#adb5bd;">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="badge rounded-circle p-2 me-3"
                 style="width:40px;height:40px;
                        display:flex;align-items:center;justify-content:center;
                        background-color:#6c757d;color:#ffffff;">
                <strong>3</strong>
            </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-2">
                                            <i class="bi bi-clipboard-data me-2" style="color:#6c757d;"></i>
                                            Exit Survey Terisi
                                        </h5>
                                        <p class="card-text text-muted mb-0">
                                            Mengisi exit survey atau tracer study sebagai evaluasi terhadap proses pembelajaran dan kepuasan mahasiswa selama menempuh pendidikan di institusi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="card mb-3 border-start border-4" style="border-color:#adb5bd;">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="badge rounded-circle p-2 me-3"
                 style="width:40px;height:40px;
                        display:flex;align-items:center;justify-content:center;
                        background-color:#6c757d;color:#ffffff;">
                <strong>4</strong>
            </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-2">
                                            <i class="bi bi-person-check me-2" style="color:#6c757d;"></i>
                                            Pendaftaran Wisuda
                                        </h5>
                                        <p class="card-text text-muted mb-0">
                                            Telah melakukan pendaftaran wisuda melalui sistem akademik dengan mengisi formulir dan mengunggah dokumen yang diperlukan sesuai jadwal yang ditentukan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 5 -->
                        <div class="card mb-3 border-start border-4" style="border-color:#adb5bd;">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="badge rounded-circle p-2 me-3"
                 style="width:40px;height:40px;
                        display:flex;align-items:center;justify-content:center;
                        background-color:#6c757d;color:#ffffff;">
                <strong>5</strong>
            </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-2">
                                            <i class="bi bi-check-circle me-2" style="color:#6c757d;"></i>
                                            Clearance Lengkap
                                        </h5>
                                        <p class="card-text text-muted mb-0">
                                            Menyelesaikan seluruh proses clearance dari berbagai unit seperti perpustakaan (bebas pinjaman buku), laboratorium, jurusan, dan unit lainnya. Pastikan tidak ada kewajiban yang belum diselesaikan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 6 -->
                        <div class="card mb-3 border-start border-4" style="border-color:#adb5bd;">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="badge bg-secondary rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                        <strong>6</strong>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-2">
                                            <i class="bi bi-list-check text-secondary me-2"></i>
                                            Masuk List Yudisium
                                        </h5>
                                        <p class="card-text text-muted mb-0">
                                            Nama Anda tercantum dalam daftar peserta yudisium yang telah diverifikasi dan disetujui oleh fakultas/program studi. Yudisium adalah sidang penetapan kelulusan mahasiswa.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Important Notes -->
                    <div class="alert alert-warning border-0 mt-4" role="alert">
                        <h5 class="alert-heading">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Catatan Penting
                        </h5>
                        <hr>
                        <ul class="mb-0 ps-3">
                            <li class="mb-2">Verifikasi semua persyaratan di atas minimal <strong>2 minggu sebelum jadwal wisuda</strong></li>
                            <li class="mb-2">Hubungi bagian akademik jika ada kendala dalam memenuhi persyaratan</li>
                            <li class="mb-2">Mahasiswa yang belum memenuhi seluruh persyaratan tidak dapat mengikuti wisuda pada periode berjalan</li>
                            <li class="mb-0">Jadwal wisuda berikutnya dapat dikonsultasikan dengan bagian kemahasiswaan</li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 justify-content-center mt-4 flex-wrap">
    <a href="{{ route('daftar_wisuda.index') }}"
       class="btn btn-lg text-white"
       style="background-color:#980517; border-color:#980517;">
        <i class="bi bi-clipboard-check me-2"></i>
        Daftar Wisuda Sekarang
    </a>

    <a href="{{ route('beranda') }}"
       class="btn btn-lg btn-outline-danger"
       style="border-color:#980517; color:#980517;">
        <i class="bi bi-arrow-left me-2"></i>
        Kembali ke Beranda
    </a>
</div>

                </div>
            </div>

            <!-- Contact Section -->
            <div class="card shadow-sm border-0 mt-4">
    <div class="card-body text-center p-4"
         style="background: linear-gradient(135deg, #980517 0%, #c4162a 60%, #ff4b5c 100%);
                color:#ffffff;">
        <h5 class="mb-3 fw-semibold">
            <i class="bi bi-question-circle-fill me-2"></i>
            Butuh Bantuan?
        </h5>

        <p class="mb-3" style="color:#ffe5e8;">
            Jika ada pertanyaan mengenai persyaratan wisuda, silakan hubungi:
        </p>

        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <div>
                <i class="bi bi-envelope-fill me-2"></i>
                <a href="mailto:akademik@university.ac.id"
                   class="text-decoration-none fw-medium"
                   style="color:#ffd1d6;">
                    akademik@university.ac.id
                </a>
            </div>
            <div>
                <i class="bi bi-telephone-fill me-2"></i>
                <a href="tel:+62211234567"
                   class="text-decoration-none fw-medium"
                   style="color:#ffd1d6;">
                    +62 21 1234 567
                </a>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .badge {
        font-size: 1rem;
    }
</style>
@endsection