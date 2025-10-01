<!-- Modal Edit SKPI -->
<div class="modal fade" id="editSkpiModal" tabindex="-1" aria-labelledby="editSkpiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editSkpiForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSkpiModalLabel">Edit Pengajuan SKPI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_skpi" id="edit_id">

                    <div class="mb-3">
                        <label for="edit_tgl" class="form-label">Tanggal Pengajuan</label>
                        <input type="date" class="form-control" id="edit_tgl" name="tgl_pengajuan_mahasiswa" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_jenjang" class="form-label">Jenjang</label>
                        <input type="text" class="form-control" id="edit_jenjang" name="jenjang_mahasiswa" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control" id="edit_hp" name="no_hp_mahasiswa" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email_mahasiswa" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat_mahasiswa" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_ttd" class="form-label">Tanda Tangan</label>
                        <input type="file" class="form-control" id="edit_ttd" name="ttd_mahasiswa">
                        <small>Biarkan kosong jika tidak ingin mengganti</small>
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
