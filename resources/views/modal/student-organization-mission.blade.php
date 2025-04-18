<div class="modal" id="createModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Tambah Misi</p>
        </div>
        <div class="content-body">
            <form id="buttonCreateStudentOrganizationMission" class="form" method="POST">
                @csrf
                <div class="form-input">
                    <label for="name">Misi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama misi...">
                    @error('name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary">Tambah Misi</button>
                    <button type="button" onclick="closeModal('createModal')" class="button-secondary">Batal Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="detailModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Detail Misi</p>
        </div>
        <div class="content-body">
            <form class="form">
                <div class="form-input">
                    <label for="name">Misi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama misi..." readonly>
                </div>
                <div class="button-group">
                    <button type="button" onclick="closeModal('detailModal')" class="button-secondary">Tutup Modal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Edit Misi</p>
        </div>
        <div class="content-body">
            <form id="buttonEditStudentOrganizationMission" class="form" method="POST">
                @csrf
                @method('PUT')
                <div class="form-input">
                    <label for="name">Misi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama misi...">
                    @error('name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary">Simpan Perubahan</button>
                    <button type="button" onclick="closeModal('editModal')" class="button-secondary">Batal Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Hapus Misi</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteStudentOrganizationMission" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data misi ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button type="submit" class="button-primary">Hapus Misi</button>
                    <button type="button" onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
