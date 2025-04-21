<div class="modal" id="createModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Tambah Info Panitia Divisi</p>
        </div>
        <div class="content-body">
            <form id="buttonCreateInfoCommitteeDivision" class="form" method="POST">
                @csrf
                <div class="form-input lg:col-span-2">
                    <label for="name">Nama Divisi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama divisi...">
                    @error('name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="definition">Definisi</label>
                    <textarea class="input" name="definition" placeholder="Masukkan definisi divisi..." rows="4"></textarea>
                    @error('definition')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary">Tambah Info Panitia Divisi</button>
                    <button type="button" onclick="closeModal('createModal')" class="button-secondary">Batal Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="detailModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Detail Info Panitia Divisi</p>
        </div>
        <div class="content-body">
            <form class="form">
                <div class="form-input lg:col-span-2">
                    <label for="name">Nama Divisi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama divisi..." readonly>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="definition">Definisi</label>
                    <textarea class="input" name="definition" placeholder="Masukkan definisi divisi..." rows="4" readonly></textarea>
                </div>
                <hr class="style-gap lg:col-span-2">
                <div class="form-input lg:col-span-2">
                    <label for="task">Total Tugas</label>
                    <div class="input-wrapper">
                        <input type="text" class="input" name="task" readonly>
                        <a href="" class="button-redirect group">
                            <span class="bg-link-move-light group-hover:opacity-100"></span>
                        </a>
                    </div>
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
            <p>Edit Info Panitia Divisi</p>
        </div>
        <div class="content-body">
            <form id="buttonEditInfoCommitteeDivision" class="form" method="POST">
                @csrf
                @method('PUT')
                <div class="form-input lg:col-span-2">
                    <label for="name">Nama Divisi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama divisi...">
                    @error('name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="definition">Definisi</label>
                    <textarea class="input" name="definition" placeholder="Masukkan definisi divisi..." rows="4"></textarea>
                    @error('definition')
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
            <p>Hapus Info Panitia Divisi</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteInfoCommitteeDivision" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data info panitia divisi ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button type="submit" class="button-primary">Hapus Info Panitia Divisi</button>
                    <button type="button" onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
