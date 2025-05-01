<div class="modal" id="createModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Tambah Prestasi</p>
        </div>
        <div class="content-body">
            <form id="buttonCreateStudentActivityUnitAchievement" class="form" method="POST">
                @csrf
                <div class="form-input lg:col-span-2">
                    <label for="name">Nama Prestasi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama prestasi...">
                    @error('name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="description">Deskripsi</label>
                    <textarea class="input" name="description" placeholder="Masukkan deskripsi prestasi..." rows="4"></textarea>
                    @error('description')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary">Tambah Prestasi</button>
                    <button type="button" onclick="closeModal('createModal')" class="button-secondary">Batal Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="detailModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Detail Prestasi</p>
        </div>
        <div class="content-body">
            <form class="form">
                <div class="form-input lg:col-span-2">
                    <label for="name">Nama Prestasi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama prestasi..." readonly>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="description">Deskripsi</label>
                    <textarea class="input" name="description" placeholder="Masukkan deskripsi prestasi..." rows="4" readonly></textarea>
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
            <p>Edit Prestasi</p>
        </div>
        <div class="content-body">
            <form id="buttonEditStudentActivityUnitAchievement" class="form" method="POST">
                @csrf
                @method('PUT')
                <div class="form-input lg:col-span-2">
                    <label for="name">Nama Prestasi</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama prestasi...">
                    @error('name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="description">Deskripsi</label>
                    <textarea class="input" name="description" placeholder="Masukkan deskripsi prestasi..." rows="4"></textarea>
                    @error('description')
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
            <p>Hapus Prestasi</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteStudentActivityUnitAchievement" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data prestasi ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button type="submit" class="button-primary">Hapus Prestasi</button>
                    <button type="button" onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
