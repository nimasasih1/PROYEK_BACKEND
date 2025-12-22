@extends('1layouts.dashboard')

@section('content')
<div class="container py-4">
  {{-- Modal Tambah Informasi Wisuda --}}
  <div class="modal fade show" id="tambahInfoModal" tabindex="-1" aria-labelledby="tambahInfoModalLabel" aria-modal="true" role="dialog" style="display: block; background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 rounded-4 shadow">
        <div class="modal-header text-white" style="background-color: #800000; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
          <h5 class="modal-title text-white" id="tambahInfoModalLabel">
            <i class="bi bi-mortarboard-fill me-2 text-white"></i>Tambah Informasi Wisuda
          </h5>
          <a href="{{ url('/dashboard/index1') }}" class="btn-close btn-close-white" aria-label="Close"></a>
        </div>

        <form action="{{ route('dashboard.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row g-3">

              <div class="col-md-6">
                <label class="form-label fw-semibold">Lokasi</label>
                <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Aula Kampus Utama" required>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Jumlah Wisudawan</label>
                <input type="number" name="jumlah_wisudawan" class="form-control" placeholder="Masukkan jumlah" required>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Jadwal Wisuda</label>
                <input type="date" name="jadwal_wisuda" class="form-control" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-semibold">Informasi BAAK</label>
                <textarea name="informasi_baak" class="form-control" rows="3" placeholder="Masukkan informasi resmi dari BAAK..."></textarea>
              </div>

          
            </div>
          </div>

          <div class="modal-footer d-flex justify-content-end">
            <a href="{{ url('/dashboard/index1') }}" class="btn btn-outline-secondary">
              <i class="bi bi-x-circle me-1"></i> Batal
            </a>
            <button type="submit" class="btn text-white" style="background-color: #800000;">
              <i class="bi bi-save-fill me-1"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection