@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form action="{{ route('event.update', $event) }}" method="POST" class="form lg:!grid-cols-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-input lg:col-span-2">
                <label>
                    Foto Event
                    <span class="input-image">
                        <img src="{{ $event->image_path ? asset('assets/image/event/' . $event->image_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="image-preview">
                        <input type="file" class="image-input-hidden" id="image_path" name="image_path">
                        <div class="button-secondary image-button">Pilih foto</div>
                    </span>
                </label>
                @error('image_path')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            @if(auth()->user()->admin)
                <div class="form-input">
                    <label for="student_organizations_id">Organisasi Mahasiswa</label>
                    <select class="input" name="student_organizations_id" id="student_organizations_id">
                        <option value="">Pilih organisasi mahasiswa event...</option>
                        @foreach($studentOrganizations as $studentOrganization)
                            <option value="{{ $studentOrganization->id }}" {{ $event->student_organizations_id === $studentOrganization->id ? 'selected' : '' }}>{{ $studentOrganization->name }}</option>
                        @endforeach
                    </select>
                    @error('student_organizations_id')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
            @elseif(auth()->user()->student_organization)
                <input type="hidden" name="student_organizations_id" value="{{ auth()->user()->student_organization->id }}">
            @endif
            @if(auth()->user()->admin)
                <div class="form-input">
                    <label for="student_activity_units_id">UKM</label>
                    <select class="input" name="student_activity_units_id" id="student_activity_units_id">
                        <option value="">Pilih ukm event...</option>
                        @foreach($studentActivityUnits as $studentActivityUnit)
                            <option value="{{ $studentActivityUnit->id }}" {{ $event->student_activity_units_id === $studentActivityUnit->id ? 'selected' : '' }}>{{ $studentActivityUnit->name }}</option>
                        @endforeach
                    </select>
                    @error('student_activity_units_id')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
            @elseif(auth()->user()->student_activity_unit)
                <input type="hidden" name="student_activity_units_id" value="{{ auth()->user()->student_activity_unit->id }}">
            @endif
            <div class="form-input">
                <label for="name">Nama Event</label>
                <input type="text" class="input" name="name" placeholder="Masukkan nama event..." value="{{ $event->name }}">
                @error('name')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="link_group_wa">Link Grup WA</label>
                <input type="text" class="input" name="link_group_wa" placeholder="Masukkan link grup wa event..." value="{{ $event->link_group_wa }}">
                @error('link_group_wa')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea class="input" name="description" placeholder="Masukkan deskripsi event..." rows="4">{{ $event->description }}</textarea>
                @error('description')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
                <a href="{{ route('event.index') }}" class="button-secondary">Batal Edit</a>
            </div>
        </form>
    </div>

    <script>
        const imagePreview = document.querySelector('.image-preview');
        const imageInput = document.querySelector('.image-input-hidden');

        imageInput.addEventListener('change', function() {
            imagePreview.src = URL.createObjectURL(imageInput.files[0]);
        });
    </script>
@endsection
