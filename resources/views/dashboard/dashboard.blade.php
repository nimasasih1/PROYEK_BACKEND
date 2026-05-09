@extends('layouts.dashboard')

@section('content')


<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0" title="Ringkasan Dashboard">
        <i class="bi bi-speedometer2 me-2"></i>Dashboard Overview
    </h4>
    <div class="text-muted">
        <i class="bi bi-calendar3 me-1"></i> {{ date('d F Y') }}
    </div>
</div>

<!-- Notifikasi Pendaftaran Baru -->
@if(isset($pendaftaranBaru) && $pendaftaranBaru->count() > 0)
<div class="alert alert-info alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
    <div class="d-flex align-items-center">
        <div class="me-3">
            <i class="bi bi-bell-fill fs-3"></i>
        </div>
        <div class="flex-grow-1">
            <h6 class="alert-heading mb-1">
                <i class="bi bi-info-circle me-2"></i><span title="Pendaftaran Wisuda Baru">New Graduation Registration!</span>
            </h6>
            <p class="mb-0">
                <span title="Ada pendaftaran wisuda baru yang perlu diverifikasi">There are <strong>{{ $pendaftaranBaru->count() }}</strong> new graduation registrations pending verification.</span>
            </p>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif


<!-- Stats Cards Row 2 - Clickable -->
<div class="row g-4 mb-4">

    <div class="col-md-4">
        <a href="{{ route('viewmahasiswa.togaselesai') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 card-hover bg-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-bag-check-fill me-1"></i><span title="Pengambilan Toga">Gown Pickup</span>
                            </h6>
                            <h3 class="fw-bold text-info mb-0">{{ $togaDiambil }}</h3>
                        </div>
                        <!-- Kotak icon putih -->
                        <div class="bg-light rounded p-3 d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                            <i class="bi bi-mortarboard-fill text-info fs-4"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-info" role="progressbar"
                            style="width: {{ $wisudaSelesai > 0 ? ($togaDiambil / $wisudaSelesai * 100) : 0 }}%">
                        </div>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="bi bi-check-circle me-1"></i><span title="Status: Sudah Diambil">Status: Collected</span>
                    </small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('viewmahasiswa.togaselesai') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 card-hover bg-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-bag-x-fill me-1"></i><span title="Toga Belum Diambil">Gown Not Collected</span>
                            </h6>
                            <h3 class="fw-bold text-warning mb-0">{{ $wisudaSelesai - $togaDiambil }}</h3>
                        </div>
                        <!-- Kotak icon putih -->
                        <div class="bg-light rounded p-3 d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" role="progressbar"
                            style="width: {{ $wisudaSelesai > 0 ? (($wisudaSelesai - $togaDiambil) / $wisudaSelesai * 100) : 0 }}%">
                        </div>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="bi bi-clock me-1"></i><span title="Perlu segera diambil">Needs to be collected soon</span>
                    </small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 bg-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted mb-2">
                            <i class="bi bi-graph-up-arrow me-1"></i><span title="Tingkat Kelulusan">Graduation Rate</span>
                        </h6>
                        <h3 class="fw-bold text-success mb-0">
                            {{ $jumlahMahasiswa > 0 ? round(($wisudaSelesai / $jumlahMahasiswa * 100), 1) : 0 }}%
                        </h3>
                    </div>
                    <!-- Kotak icon putih -->
                    <div class="bg-light rounded p-3 d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                        <i class="bi bi-trophy-fill text-success fs-4"></i>
                    </div>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-success" role="progressbar"
                        style="width: {{ $jumlahMahasiswa > 0 ? ($wisudaSelesai / $jumlahMahasiswa * 100) : 0 }}%">
                    </div>
                </div>
                <small class="text-muted mt-2 d-block">
                    <i class="bi bi-award me-1"></i><span title="Dari total mahasiswa">Of total students</span>
                </small>
            </div>
        </div>
    </div>

</div>


<!-- Tabel Pendaftaran Wisuda Terbaru -->
@if(isset($pendaftaranBaru) && $pendaftaranBaru->count() > 0)
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-bell-fill text-warning me-2"></i>
                        <span title="Pendaftaran Wisuda Terbaru">Latest Graduation Registrations</span>
                    </h5>
                    <span class="badge bg-warning text-dark">
                        <i class="bi bi-clock me-1"></i>{{ $pendaftaranBaru->count() }} <span title="Baru">New</span>
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">
                                    <i class="bi bi-hash me-1"></i>No
                                </th>
                                <th>
                                    <i class="bi bi-person-fill me-1"></i><span title="Nama Mahasiswa">Student Name</span>
                                </th>
                                <th>
                                    <i class="bi bi-credit-card-2-front me-1"></i><span title="Nomor Induk Mahasiswa">Student ID</span>
                                </th>
                                <th>
                                    <i class="bi bi-building me-1"></i><span title="Fakultas">Faculty</span>
                                </th>
                                <th>
                                    <i class="bi bi-calendar-event me-1"></i><span title="Tanggal Mendaftar">Registration Date</span>
                                </th>
                                <th>
                                    <i class="bi bi-info-circle me-1"></i><span title="Status Pendaftaran">Status</span>
                                </th>
                                <th class="text-center pe-4">
                                    <i class="bi bi-gear-fill me-1"></i><span title="Aksi">Action</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftaranBaru as $index => $pendaftaran)
                            <tr>
                                <td class="ps-4">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                            <i class="bi bi-person-fill text-primary"></i>
                                        </div>
                                        <strong>{{ $pendaftaran->mahasiswa->nama_mahasiswa ?? '-' }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $pendaftaran->mahasiswa->nim ?? '-' }}
                                    </span>
                                </td>
                                <td>{{ $pendaftaran->mahasiswa->fakultas ?? '-' }}</td>
                                <td>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $pendaftaran->created_at->format('d M Y, H:i') }}
                                    </small>
                                </td>
                                <td>
                                    @if($pendaftaran->status_pendaftaran == 'pending')
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock me-1"></i>Pending
                                    </span>
                                    @elseif($pendaftaran->status_pendaftaran == 'disetujui')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i><span title="Disetujui">Approved</span>
                                    </span>
                                    @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i><span title="Ditolak">Rejected</span>
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <a href="{{ route('viewmahasiswa.pending') }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye me-1"></i><span title="Lihat Detail">View Details</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        <span title="Menampilkan pendaftaran terbaru">Showing {{ $pendaftaranBaru->count() }} latest registrations</span>
                    </small>
                    <a href="{{ route('viewmahasiswa.pending') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-arrow-right-circle me-1"></i><span title="Lihat Semua">View All</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Charts Row -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                        <span title="Mahasiswa per Fakultas">Students per Faculty</span>
                    </h5>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-primary active" onclick="changeChartType('bar')">
                            <i class="bi bi-bar-chart"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary" onclick="changeChartType('line')">
                            <i class="bi bi-graph-up"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary" onclick="changeChartType('pie')">
                            <i class="bi bi-pie-chart"></i>
                        </button>
                    </div>
                </div>
                <canvas id="fakultasChart" style="max-height: 350px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-pie-chart-fill text-success me-2"></i>
                    <span title="Status Wisuda">Graduation Status</span>
                </h5>
                <canvas id="statusChart" style="max-height: 300px;"></canvas>

                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                        <span class="text-muted">
                            <i class="bi bi-circle-fill text-success me-2"></i><span title="Selesai">Completed</span>
                        </span>
                        <strong>{{ $wisudaSelesai }}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                        <span class="text-muted">
                            <i class="bi bi-circle-fill text-warning me-2"></i><span title="Belum Selesai">Incomplete</span>
                        </span>
                        <strong>{{ $wisudaBelum }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity & Quick Stats -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-clipboard-data-fill text-info me-2"></i>
                    <span title="Statistik SKPI">SKPI Statistics</span>
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    <i class="bi bi-tag-fill me-1"></i><span title="Status">Status</span>
                                </th>
                                <th class="text-end">
                                    <i class="bi bi-hash me-1"></i><span title="Jumlah">Count</span>
                                </th>
                                <th class="text-end">
                                    <i class="bi bi-percent me-1"></i><span title="Persentase">Percentage</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <span title="Terdaftar SKPI">SKPI Registered</span>
                                </td>
                                <td class="text-end fw-bold">{{ $jumlahSkpi }}</td>
                                <td class="text-end">
                                    <span class="badge bg-success">
                                        {{ $jumlahMahasiswa > 0 ? round(($jumlahSkpi / $jumlahMahasiswa * 100), 1) : 0 }}%
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="bi bi-x-circle-fill text-danger me-2"></i>
                                    <span title="Belum Daftar SKPI">Not Registered SKPI</span>
                                </td>
                                <td class="text-end fw-bold">{{ $jumlahMahasiswa - $jumlahSkpi }}</td>
                                <td class="text-end">
                                    <span class="badge bg-danger">
                                        {{ $jumlahMahasiswa > 0 ? round((($jumlahMahasiswa - $jumlahSkpi) / $jumlahMahasiswa * 100), 1) : 0 }}%
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
</div>


@endsection

@push('styles')
<style>
    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // =========================
    // Chart Mahasiswa per Fakultas
    // =========================
    const ctxFakultas = document.getElementById('fakultasChart').getContext('2d');

    let fakultasChart = new Chart(ctxFakultas, {
        type: 'bar',
        data: {
            labels: {!! json_encode($mahasiswaPerFakultas->pluck('fakultas')) !!},
            datasets: [{
                label: 'Total Students',
                data: {!! json_encode($mahasiswaPerFakultas->pluck('total')) !!},
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(118, 75, 162, 0.8)',
                    'rgba(240, 147, 251, 0.8)',
                    'rgba(245, 87, 108, 0.8)',
                    'rgba(79, 172, 254, 0.8)',
                    'rgba(0, 242, 254, 0.8)',
                    'rgba(67, 233, 123, 0.8)',
                    'rgba(56, 249, 215, 0.8)'
                ],
                borderWidth: 0,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: { font: { size: 12 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            }
        }
    });

    // =========================
    // Chart Status Wisuda
    // =========================
    const ctxStatus = document.getElementById('statusChart').getContext('2d');

    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Graduated', 'Pending'],
            datasets: [{
                data: [{{ $wisudaSelesai }}, {{ $wisudaBelum }}],
                backgroundColor: [
                    'rgba(67, 233, 123, 0.8)',
                    'rgba(245, 87, 108, 0.8)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { backgroundColor: 'rgba(0,0,0,0.8)', padding: 12, cornerRadius: 8 }
            }
        }
    });

    // =========================
    // Fungsi Ubah Tipe Chart Fakultas
    // =========================
    function changeChartType(type, event) {
        fakultasChart.destroy();

        fakultasChart = new Chart(ctxFakultas, {
            type: type,
            data: {
                labels: {!! json_encode($mahasiswaPerFakultas->pluck('fakultas')) !!},
                datasets: [{
                    label: 'Total Students',
                    data: {!! json_encode($mahasiswaPerFakultas->pluck('total')) !!},
                    backgroundColor: (type === 'pie' || type === 'doughnut') ? [
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(118, 75, 162, 0.8)',
                        'rgba(240, 147, 251, 0.8)',
                        'rgba(245, 87, 108, 0.8)',
                        'rgba(79, 172, 254, 0.8)',
                        'rgba(0, 242, 254, 0.8)',
                        'rgba(67, 233, 123, 0.8)',
                        'rgba(56, 249, 215, 0.8)'
                    ] : 'rgba(102, 126, 234, 0.8)',
                    borderColor: type === 'line' ? 'rgba(102,126,234,1)' : undefined,
                    borderWidth: type === 'line' ? 2 : 0,
                    tension: type === 'line' ? 0.4 : 0,
                    fill: type === 'line' ? true : false,
                    borderRadius: type === 'bar' ? 8 : 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: type === 'pie' || type === 'doughnut' },
                    tooltip: { backgroundColor: 'rgba(0,0,0,0.8)', padding: 12, cornerRadius: 8 }
                },
                scales: (type === 'pie' || type === 'doughnut') ? {} : {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Update tombol aktif
        document.querySelectorAll('.btn-group button').forEach(btn => btn.classList.remove('active'));
        event.target.closest('button').classList.add('active');
    }
</script>
@endpush


@endpush