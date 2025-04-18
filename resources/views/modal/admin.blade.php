<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Hapus Admin</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteAdmin" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data admin ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button class="button-primary">Hapus Admin</button>
                    <button onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
