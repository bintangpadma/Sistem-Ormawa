<div class="modal" id="createModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Tambah Info Panitia</p>
        </div>
        <div class="content-body">
            <form id="buttonCreateInfoCommittee" class="form" method="POST">
                @csrf
                <div class="form-input lg:col-span-2">
                    <label for="committee_definition">Definisi Panitia</label>
                    <textarea class="input" name="committee_definition" placeholder="Masukkan definisi panitia..." rows="4"></textarea>
                    @error('committee_definition')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary">Tambah Info Panitia</button>
                    <button type="button" onclick="closeModal('createModal')" class="button-secondary">Batal Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="detailModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Detail Info Panitia</p>
        </div>
        <div class="content-body">
            <form class="form">
                <div class="form-input lg:col-span-2">
                    <label for="total_division">Total Divisi</label>
                    <div class="input-wrapper">
                        <input type="text" class="input" name="total_division" readonly>
                        <a href="" class="button-redirect group">
                            <span class="bg-link-move-light group-hover:opacity-100"></span>
                        </a>
                    </div>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="committee_definition">Definisi Panitia</label>
                    <textarea class="input" name="committee_definition" placeholder="Masukkan definisi panitia..." rows="4" readonly></textarea>
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
            <p>Edit Info Panitia</p>
        </div>
        <div class="content-body">
            <form id="buttonEditInfoCommittee" class="form" method="POST">
                @csrf
                @method('PUT')
                <div class="form-input lg:col-span-2">
                    <label for="committee_definition">Definisi Panitia</label>
                    <textarea class="input" name="committee_definition" placeholder="Masukkan definisi panitia..." rows="4"></textarea>
                    @error('committee_definition')
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
            <p>Hapus Info Panitia</p>
        </div>
        <div class="content-body">
            <form id="buttonDeleteInfoCommittee" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data info panitia ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button type="submit" class="button-primary">Hapus Info Panitia</button>
                    <button type="button" onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
