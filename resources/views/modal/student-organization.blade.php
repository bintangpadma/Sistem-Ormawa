<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Hapus Organisasi Mahasiswa</p>
        </div>
        <div class="content-body">
            <p>Menghapus data organisasi mahasiswa ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
            <div class="button-group flex justify-between items-center gap-[8px]">
                <form id="buttonDeleteStudentOrganization" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="button-primary">Hapus Ormawa</button>
                </form>
                <button onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
            </div>
        </div>
    </div>
</div>
