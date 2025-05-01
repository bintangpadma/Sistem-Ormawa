<div class="modal" id="createModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Tambah Visi</p>
        </div>
        <div class="content-body">
            <form id="buttonCreateStudentActivityUnitVision" class="form" method="POST">
                @csrf
                <div class="form-input">
                    <label for="name">Visi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama visi...">
                    @error('name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary">Tambah Visi</button>
                    <button type="button" onclick="closeModal('createModal')" class="button-secondary">Batal Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="detailModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Detail Visi</p>
        </div>
        <div class="content-body">
            <form class="form">
                <div class="form-input">
                    <label for="name">Visi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama visi..." readonly>
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
            <p>Edit Visi</p>
        </div>
        <div class="content-body">
            <form id="buttonEditStudentActivityUnitVision" class="form" method="POST">
                @csrf
                @method('PUT')
                <div class="form-input">
                    <label for="name">Visi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama visi...">
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
            <p>Hapus Visi</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteStudentActivityUnitVision" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data visi ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button type="submit" class="button-primary">Hapus Visi</button>
                    <button type="button" onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
