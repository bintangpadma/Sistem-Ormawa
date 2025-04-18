<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Hapus Event</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteEvent" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data event ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button type="submit" class="button-primary">Hapus Event</button>
                    <button type="button" onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
