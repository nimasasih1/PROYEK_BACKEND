<!-- Modal Edit Wisuda -->
<div class="modal fade" id="editWisudaModal" tabindex="-1" aria-labelledby="editWisudaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editWisudaForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editWisudaModalLabel">Edit Pendaftaran Wisuda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_pendaftaran" id="edit_id_pendaftaran">

                    <div class="mb-3">
                        <label for="edit_tgl_pendaftaran" class="form-label">Tanggal Pendaftaran</label>
                        <input type="date" class="form-control" id="edit_tgl_pendaftaran" name="tgl_pendaftaran" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_ukuran" class="form-label">Ukuran Toga</label>
                        <input type="text" class="form-control" id="edit_ukuran" name="ukuran" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="edit_catatan" name="catatan"></textarea>
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
