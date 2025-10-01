<!-- Modal Edit Profil Mahasiswa -->
<div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editProfilForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfilModalLabel">Edit Profil Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="edit_nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="edit_nim" name="nim" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama_mahasiswa" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_fakultas" class="form-label">Fakultas</label>
                        <input type="text" class="form-control" id="edit_fakultas" name="fakultas" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_prodi" class="form-label">Prodi</label>
                        <input type="text" class="form-control" id="edit_prodi" name="prodi" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="edit_tahun" name="tahun" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
