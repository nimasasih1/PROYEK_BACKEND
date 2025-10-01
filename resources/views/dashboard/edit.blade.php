@extends('layouts.dashboard')

@section('content')
<h2>Edit Informasi Wisuda</h2>

<form action="{{ route('dashboard.update', $info->id_info) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label>Jadwal Undangan</label>
    <input type="date" name="jadwal_undangan" value="{{ $info->jadwal_undangan }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Lokasi</label>
    <input type="text" name="lokasi" value="{{ $info->lokasi }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Jumlah Wisudawan</label>
    <input type="number" name="jumlah_wisudawan" value="{{ $info->jumlah_wisudawan }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Informasi BAAK</label>
    <textarea name="informasi_baak" class="form-control">{{ $info->informasi_baak }}</textarea>
  </div>
  <div class="mb-3">
    <label>Info Lulusan</label>
    <textarea name="info_lulusan" class="form-control">{{ $info->info_lulusan }}</textarea>
  </div>
  <div class="mb-3">
    <label>Jadwal Wisuda</label>
    <input type="date" name="jadwal_wisuda" value="{{ $info->jadwal_wisuda }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Review</label>
    <textarea name="review" class="form-control">{{ $info->review }}</textarea>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
