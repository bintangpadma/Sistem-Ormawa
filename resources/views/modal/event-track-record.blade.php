<div class="modal" id="createModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Tambah Rekam Jejak Event</p>
        </div>
        <div class="content-body">
            <form id="buttonCreateEventTrackRecord" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-input lg:col-span-2">
                    <label>
                        Foto Rekam Jejak
                        <span class="input-image">
                            <img src="https://placehold.co/100?text=Image+Not+Found" alt="Image Not Found" class="image-preview image-preview-create">
                            <input type="file" class="image-input-hidden image-input-hidden-create" id="image_path" name="image_path">
                            <div class="button-secondary image-button">Pilih foto</div>
                        </span>
                    </label>
                    @error('image_path')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="title">Nama Event</label>
                    <input type="text" class="input" name="title" placeholder="Masukkan nama rekam jejak event...">
                    @error('title')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="year">Tahun</label>
                    <input type="number" class="input" name="year" placeholder="Masukkan tahun rekam jejak event...">
                    @error('year')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="description">Deskripsi</label>
                    <textarea class="input" name="description" placeholder="Masukkan deskripsi rekam jejak event..." rows="4"></textarea>
                    @error('description')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary">Tambah Rekam Jejak Event</button>
                    <button type="button" onclick="closeModal('createModal')" class="button-secondary">Batal Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="detailModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Detail Rekam Jejak Event</p>
        </div>
        <div class="content-body">
            <form class="form">
                <div class="form-input lg:col-span-2">
                    <label>
                        Foto Rekam Jejak
                        <span class="input-image">
                        <img src="https://placehold.co/100?text=Image+Not+Found" alt="Image Not Found" class="image-preview image-preview-detail">
                    </span>
                    </label>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="title">Nama Event</label>
                    <input type="text" class="input" name="title" placeholder="Masukkan nama rekam jejak event..." readonly>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="year">Tahun</label>
                    <input type="number" class="input" name="year" placeholder="Masukkan tahun rekam jejak event..." readonly>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="description">Deskripsi</label>
                    <textarea class="input" name="description" placeholder="Masukkan deskripsi rekam jejak event..." readonly rows="4"></textarea>
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
            <p>Edit Rekam Jejak Event</p>
        </div>
        <div class="content-body">
            <form id="buttonEditEventTrackRecord" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-input lg:col-span-2">
                    <label>
                        Foto Rekam Jejak
                        <span class="input-image">
                        <img src="https://placehold.co/100?text=Image+Not+Found" alt="Image Not Found" class="image-preview image-preview-edit">
                        <input type="file" class="image-input-hidden image-input-hidden-edit" id="image_path" name="image_path">
                        <div class="button-secondary image-button">Pilih foto</div>
                    </span>
                    </label>
                    @error('image_path')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="title">Nama Event</label>
                    <input type="text" class="input" name="title" placeholder="Masukkan nama rekam jejak event...">
                    @error('title')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="year">Tahun</label>
                    <input type="number" class="input" name="year" placeholder="Masukkan tahun rekam jejak event...">
                    @error('year')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="description">Deskripsi</label>
                    <textarea class="input" name="description" placeholder="Masukkan deskripsi rekam jejak event..." rows="4"></textarea>
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
            <p>Hapus Rekam Jejak Event</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteEventTrackRecord" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data rekam jejak event ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button type="submit" class="button-primary">Hapus Rekam Jejak Event</button>
                    <button type="button" onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
