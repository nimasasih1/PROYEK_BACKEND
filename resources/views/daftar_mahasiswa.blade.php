 <h2 class="mt-4">Daftar Mahasiswa</h2>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Prodi</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa->id_mahasiswa }}</td>
                    <td>{{ $mahasiswa->nim }}</td>
                    <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                    <td>{{ $mahasiswa->prodi }}</td>
                    <td>{{ $mahasiswa->tahun }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>