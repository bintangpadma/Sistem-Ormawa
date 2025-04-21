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
                <input type="search" class="input" name="search" placeholder="Cari tugas rekam jejak event..." value="{{ $search }}">
            </form>
            <button class="button-primary" data-target="createModal" onclick="openModal(this)">Tambah Tugas</button>
        </div>
        <div class="table-group">
            <table>
                <thead>
                <tr>
                    <th>Nama</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if ($eventTrackRecordTasks->count() == 0)
                    <td colspan="2">Data tugas rekam jejak event tidak ditemukan!</td>
                @else
                    @foreach ($eventTrackRecordTasks as $eventTrackRecordTask)
                        <tr>
                            <td>{{ $eventTrackRecordTask->name }}</td>
                            <td>
                                <div class="action-button">
                                    <button class="button icon-detail" data-target="detailModal" data-id="{{ $eventTrackRecordTask->id }}" onclick="openModal(this)">
                                        <span class="bg-detail-primary"></span>
                                    </button>
                                    <button class="button icon-edit" data-target="editModal" data-id="{{ $eventTrackRecordTask->id }}" onclick="openModal(this)">
                                        <span class="bg-edit-warning"></span>
                                    </button>
                                    <button class="button icon-delete" data-target="deleteModal" data-id="{{ $eventTrackRecordTask->id }}" onclick="openModal(this)">
                                        <span class="bg-delete-danger"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        @if(count($eventTrackRecordTasks) > 10)
            <div class="table-paginate">
                {{ $eventTrackRecordTasks->links() }}
            </div>
        @endif
    </div>
    @include('modal.event-track-record-task')

    <script>
        const eventId = @json($event->id);
        const eventTrackRecordId = @json($eventTrackRecord->id);

        function fetchTrackRecordTask(modal, trackRecordTaskId) {
            fetch('/event/' + eventId + '/track-record/' + eventTrackRecordId + '/task/' + trackRecordTaskId, {
                method: 'GET',
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status_code === 200) {
                        modal.querySelector('input[name="name"]').value = data.event_track_record_task.name;
                    } else {
                        console.log('Data event track record task not found!');
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
                document.getElementById('buttonCreateEventTrackRecordTask').setAttribute('action', '/event/' + eventId + '/track-record/' + eventTrackRecordId + '/task')
            } else if (modalTarget.includes('detail')) {
                await fetchTrackRecordTask(modal, modalId)
            } else if (modalTarget.includes('edit')) {
                await fetchTrackRecordTask(modal, modalId)
                document.getElementById('buttonEditEventTrackRecordTask').setAttribute('action', '/event/' + eventId + '/track-record/' + eventTrackRecordId + '/task/' + modalId)
            } else if (modalTarget.includes('delete')) {
                document.getElementById('buttonDeleteEventTrackRecordTask').setAttribute('action', '/event/' + eventId + '/track-record/' + eventTrackRecordId + '/task/' + modalId)
            }
        }

        function closeModal(modalTarget) {
            document.getElementById(`${modalTarget}`).classList.remove('show')
        }
    </script>
@endsection
