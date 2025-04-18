<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Hapus Organisasi Mahasiswa</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteStudentOrganization" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data organisasi mahasiswa ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                        <button class="button-primary">Hapus Ormawa</button>
                    <button onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
