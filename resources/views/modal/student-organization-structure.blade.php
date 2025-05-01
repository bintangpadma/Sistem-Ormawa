<div class="modal" id="createModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Tambah Struktur</p>
        </div>
        <div class="content-body">
            <form id="buttonCreateStudentOrganizationStructure" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-input lg:col-span-2">
                    <label>
                        Foto Mahasiswa
                        <span class="input-image">
                            <img src="https://placehold.co/100?text=Image+Not+Found" alt="Image Not Found" class="image-preview image-preview-create">
                            <input type="file" class="image-input-hidden image-input-hidden-create" id="profile_path" name="profile_path">
                            <div class="button-secondary image-button">Pilih foto</div>
                        </span>
                    </label>
                    @error('profile_path')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="student_name">Nama Mahasiswa</label>
                    <input type="text" class="input" name="student_name" placeholder="Masukkan nama mahasiswa struktur...">
                    @error('student_name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="student_code">NIM</label>
                    <input type="text" class="input" name="student_code" placeholder="Masukkan nim mahasiswa struktur...">
                    @error('student_code')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="role">Role</label>
                    <input type="text" class="input" name="role" placeholder="Masukkan role struktur...">
                    @error('role')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary">Tambah Struktur</button>
                    <button type="button" onclick="closeModal('createModal')" class="button-secondary">Batal Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="detailModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Detail Struktur</p>
        </div>
        <div class="content-body">
            <form class="form">
                <div class="form-input lg:col-span-2">
                    <label>
                        Foto Mahasiswa
                        <span class="input-image">
                        <img src="https://placehold.co/100?text=Image+Not+Found" alt="Image Not Found" class="image-preview image-preview-detail">
                    </span>
                    </label>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="student_name">Nama Mahasiswa</label>
                    <input type="text" class="input" name="student_name" placeholder="Masukkan nama mahasiswa struktur..." readonly>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="student_code">NIM</label>
                    <input type="text" class="input" name="student_code" placeholder="Masukkan nim mahasiswa struktur..." readonly>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="role">Role</label>
                    <input type="text" class="input" name="role" placeholder="Masukkan role struktur..." readonly>
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
            <p>Edit Struktur</p>
        </div>
        <div class="content-body">
            <form id="buttonEditStudentOrganizationStructure" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-input lg:col-span-2">
                    <label>
                        Foto Mahasiswa
                        <span class="input-image">
                        <img src="https://placehold.co/100?text=Image+Not+Found" alt="Image Not Found" class="image-preview image-preview-edit">
                        <input type="file" class="image-input-hidden image-input-hidden-edit" id="profile_path" name="profile_path">
                        <div class="button-secondary image-button">Pilih foto</div>
                    </span>
                    </label>
                    @error('profile_path')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="student_name">Nama Mahasiswa</label>
                    <input type="text" class="input" name="student_name" placeholder="Masukkan nama mahasiswa struktur...">
                    @error('student_name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="student_code">NIM</label>
                    <input type="text" class="input" name="student_code" placeholder="Masukkan nim mahasiswa struktur...">
                    @error('student_code')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="role">Role</label>
                    <input type="text" class="input" name="role" placeholder="Masukkan role struktur...">
                    @error('role')
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
            <p>Hapus Struktur</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteStudentOrganizationStructure" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data struktur ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button type="submit" class="button-primary">Hapus Struktur</button>
                    <button type="button" onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
