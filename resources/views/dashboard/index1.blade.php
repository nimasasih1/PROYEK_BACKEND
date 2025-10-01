@extends('layouts.dashboard')

@section('content')
<h2>Daftar Informasi Wisuda</h2>

<a href="{{ route('dashboard.create') }}" class="btn btn-primary mb-3">+ Tambah Informasi</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Jadwal Undangan</th>
      <th>Lokasi</th>
      <th>Jumlah Wisudawan</th>
      <th>Jadwal Wisuda</th>
      <th>Informasi BAAK</th>
      <th>Review</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $info)
    <tr>
      <td>{{ $info->id_info }}</td>
      <td>{{ $info->jadwal_undangan }}</td>
      <td>{{ $info->lokasi }}</td>
      <td>{{ $info->jumlah_wisudawan }}</td>
      <td>{{ $info->jadwal_wisuda }}</td>
      <td>{{ $info->informasi_baak }}</td>
      <td>{{ $info->review }}</td>
      <td>
        <a href="{{ route('dashboard.edit', $info->id_info) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('dashboard.destroy', $info->id_info) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
