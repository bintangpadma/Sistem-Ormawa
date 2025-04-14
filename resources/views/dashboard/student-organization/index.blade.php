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
                <input type="search" class="input" name="search" placeholder="Cari ormawa..." value="{{ $search }}">
            </form>
            @if(auth()->user()->admin)
                <a href="{{ route('student-organization.create') }}" class="button-primary">Tambah Ormawa</a>
            @endif
        </div>
        <div class="wrapper-table">
            <table>
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Singkatan</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if ($studentOrganizations->count() == 0)
                    <td colspan="4">Data ormawa tidak ditemukan!</td>
                @else
                    @foreach ($studentOrganizations as $studentOrganization)
                        <tr>
                            <td>{{ $studentOrganization->name }}</td>
                            <td>{{ $studentOrganization->abbreviation }}</td>
                            <td>{{ Str::limit($studentOrganization->description, '40') }}</td>
                            <td>
                                <div class="action-button flex items-center gap-[4px]">
                                    <a href="{{ route('student-organization.show', $studentOrganization) }}" class="button icon-detail">
                                        <span class="bg-detail-primary"></span>
                                    </a>
                                    @if(auth()->user()->admin)
                                        <a href="{{ route('student-organization.edit', $studentOrganization) }}" class="button icon-edit">
                                            <span class="bg-edit-warning"></span>
                                        </a>
                                        <button type="button" class="button icon-delete" data-target="deleteModal" data-id="{{ $studentOrganization->id }}">
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
            {{ $studentOrganizations->links() }}
        </div>
    </div>

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
                        <button class="button-primary">Hapus Organisasi Mahasiswa</button>
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
                document.getElementById('buttonDeleteStudentOrganization').setAttribute('action', '/student-organization/' + id)
            })
        })

        function closeModal(modalTarget) {
            document.getElementById(`${modalTarget}`).classList.remove('show')
        }
    </script>
@endsection
