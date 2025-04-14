@extends('template.dashboard')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-full mb-3" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session()->has('failed'))
        <div class="alert alert-danger w-full mb-3" role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <div class="content-menu p-[16px] lg:p-[20px] border border-light/[0.06] rounded-[4px]">
        <div class="menu-header flex items-center gap-[8px] lg:gap-[12px]">
            <form method="GET" class="form">
                <input type="search" class="input" name="search" placeholder="Cari admin..." value="{{ $search }}">
            </form>
            @if(auth()->user()->admin->is_super_admin)
                <a href="{{ route('admin.create') }}" class="button-primary">Tambah Admin</a>
            @endif
        </div>
        <div class="wrapper-table">
            <table>
                <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>NIP</th>
                    <th>Nomor Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if ($admins->count() == 0)
                    <td colspan="6">Data admin tidak ditemukan!</td>
                @else
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin->full_name }}</td>
                            <td>{{ $admin->lecturer_code }}</td>
                            <td>{{ $admin->phone_number }}</td>
                            <td>{{ $admin->gender === 'male' ? 'Laki-Laki' : 'Perempuan' }}</td>
                            <td>{{ $admin->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td>
                                <div class="action-button flex items-center gap-[4px]">
                                    <a href="{{ route('admin.show', $admin) }}" class="button icon-detail">
                                        <span class="bg-detail-primary"></span>
                                    </button>
                                    @if(auth()->user()->admin->is_super_admin)
                                        <a href="{{ route('admin.edit', $admin) }}" class="button icon-edit">
                                            <span class="bg-edit-warning"></span>
                                        </a>
                                        <button type="button" class="button icon-delete" data-target="deleteModal" data-id="{{ $admin->id }}">
                                            <span class="bg-delete-danger"></span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="wrapper-paginate">
            {{ $admins->links() }}
        </div>
    </div>

    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="content-header">
                <p>Hapus Admin</p>
            </div>
            <div class="content-body">
                <p>Menghapus data admin ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group flex justify-between items-center gap-[8px]">
                    <form id="buttonDeleteAdmin" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button-primary">Hapus Admin</button>
                    </form>
                    <button class="button-secondary" onclick="closeModal('deleteModal')">Batal Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const buttonDeletes = document.querySelectorAll('[data-target="deleteModal"]');

        buttonDeletes.forEach(buttonDelete => {
            buttonDelete.addEventListener('click', function() {
                const modalTarget = buttonDelete.getAttribute('data-target')
                document.getElementById(`${modalTarget}`).classList.add('show')
                const id = buttonDelete.getAttribute('data-id')
                document.getElementById('buttonDeleteAdmin').setAttribute('action', '/admin/' + id)
            })
        })

        function closeModal(modalTarget) {
            document.getElementById(`${modalTarget}`).classList.remove('show')
        }
    </script>
@endsection
