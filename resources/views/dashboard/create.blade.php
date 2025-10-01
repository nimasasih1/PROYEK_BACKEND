@extends('layouts.dashboard')

@section('content')
<h2>Tambah Informasi Wisuda</h2>

<form action="{{ route('dashboard.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Jadwal Undangan</label>
    <input type="date" name="jadwal_undangan" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Lokasi</label>
    <input type="text" name="lokasi" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Jumlah Wisudawan</label>
    <input type="number" name="jumlah_wisudawan" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Informasi BAAK</label>
    <textarea name="informasi_baak" class="form-control"></textarea>
  </div>
  <div class="mb-3">
    <label>Info Lulusan</label>
    <textarea name="info_lulusan" class="form-control"></textarea>
  </div>
  <div class="mb-3">
    <label>Jadwal Wisuda</label>
    <input type="date" name="jadwal_wisuda" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Review</label>
    <textarea name="review" class="form-control"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
