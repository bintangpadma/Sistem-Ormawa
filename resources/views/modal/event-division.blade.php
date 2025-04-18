<div class="modal" id="createModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Tambah Divisi</p>
        </div>
        <div class="content-body">
            <form id="buttonCreateEventDivision" class="form" method="POST">
                @csrf
                <div class="form-input">
                    <label for="name">Divisi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama divisi...">
                    @error('name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary">Tambah Divisi</button>
                    <button type="button" onclick="closeModal('createModal')" class="button-secondary">Batal Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="detailModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Detail Divisi</p>
        </div>
        <div class="content-body">
            <form class="form">
                <div class="form-input">
                    <label for="name">Divisi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama divisi..." readonly>
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
            <p>Edit Divisi</p>
        </div>
        <div class="content-body">
            <form id="buttonEditEventDivision" class="form" method="POST">
                @csrf
                @method('PUT')
                <div class="form-input">
                    <label for="name">Divisi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama divisi...">
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
            <p>Hapus Divisi</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteEventDivision" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data divisi ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button type="submit" class="button-primary">Hapus Divisi</button>
                    <button type="button" onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
