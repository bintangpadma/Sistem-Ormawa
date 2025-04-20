@extends('template.dashboard')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session()->has('failed'))
        <div class="alert alert-danger" role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <div class="content-menu content-table">
        <div class="table-header">
            <form method="GET" class="form">
                <input type="search" class="input" name="search" placeholder="Cari ukm..." value="{{ $search }}">
            </form>
            @if(auth()->user()->admin)
                <button class="button-primary" data-target="createModal" onclick="openModal(this)">Tambah UKM</button>
            @endif
        </div>
        <div class="table-group">
            <table>
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Singkatan</th>
                    <th>Deskripsi</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if ($studentActivityUnits->count() == 0)
                    <td colspan="4">Data ukm tidak ditemukan!</td>
                @else
                    @foreach ($studentActivityUnits as $studentActivityUnit)
                        <tr>
                            <td>{{ $studentActivityUnit->name }}</td>
                            <td>{{ $studentActivityUnit->abbreviation }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($studentActivityUnit->description, 40) }}</td>
                            <td>
                                <div class="action-button">
                                    <button class="button icon-detail" data-target="detailModal" data-id="{{ $studentActivityUnit->id }}" onclick="openModal(this)">
                                        <span class="bg-detail-primary"></span>
                                    </button>
                                    @if(auth()->user()->admin)
                                        <button class="button icon-edit" data-target="editModal" data-id="{{ $studentActivityUnit->id }}" onclick="openModal(this)">
                                            <span class="bg-edit-warning"></span>
                                        </button>
                                        <button class="button icon-delete" data-target="deleteModal" data-id="{{ $studentActivityUnit->id }}" onclick="openModal(this)">
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
        @if(count($studentActivityUnits) > 10)
            <div class="table-paginate">
                {{ $studentActivityUnits->links() }}
            </div>
        @endif
    </div>
    @include('modal.student-activity-unit')

    <script>
        function fetchStudentActivityUnit(modal, studentActivityUnitId) {
            fetch('/student-activity-unit/' + studentActivityUnitId, {
                method: 'GET',
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status_code === 200) {
                        modal.querySelector('input[name="name"]').value = data.student_activity_unit.name;
                        modal.querySelector('input[name="abbreviation"]').value = data.student_activity_unit.abbreviation;
                        modal.querySelector('textarea[name="description"]').value = data.student_activity_unit.description;
                    } else {
                        console.log('Data student activity unit not found!');
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        async function openModal(element) {
            const modalTarget = element.getAttribute('data-target')
            const modalId = element.getAttribute('data-id')
            const modal = document.getElementById(`${modalTarget}`)
            modal.classList.add('show')
            if (modalTarget.includes('create')) {
                document.getElementById('buttonCreateStudentActivityUnit').setAttribute('action', '/student-activity-unit/')
            } else if (modalTarget.includes('detail')) {
                await fetchStudentActivityUnit(modal, modalId)
            } else if (modalTarget.includes('edit')) {
                await fetchStudentActivityUnit(modal, modalId)
                document.getElementById('buttonEditStudentActivityUnit').setAttribute('action', '/student-activity-unit/' + modalId)
            } else if (modalTarget.includes('delete')) {
                document.getElementById('buttonDeleteStudentActivityUnit').setAttribute('action', '/student-activity-unit/' + modalId)
            }
        }

        function closeModal(modalTarget) {
            document.getElementById(`${modalTarget}`).classList.remove('show')
        }
    </script>
@endsection
