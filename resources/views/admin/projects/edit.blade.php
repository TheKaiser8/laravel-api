@extends('layouts.admin')

@section('page-title')
    Modifica
@endsection

@section('content')
    <h2 class="text-decoration-underline my-3">Modifica: {{ $project->title }}</h2>
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo*</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" maxlength="150" value="{{ old('title', $project->title ) }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $project->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="customer" class="form-label">Cliente*</label>
            <input type="text" class="form-control @error('customer') is-invalid @enderror" id="customer" name="customer" maxlength="100" value="{{ old('customer', $project->customer) }}">
            @error('customer')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Immagine</label>

            {{-- preview immagine caricata --}}
            <div>
                <img @if ($project->picture) src="{{ asset("storage/$project->picture")}}" @endif id="preview" width="150" class="img-fluid mb-3"/>
                <script>
                    function loadFile(event) {
                        let reader = new FileReader();
                        reader.onload = function() {
                            let preview = document.getElementById('preview');
                            preview.src = reader.result;
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    };
                </script>
            </div>
            {{-- /preview immagine caricata --}}
            {{-- checkbox no_image --}}
            @if ($project->picture)
                <div class="form-check form-switch">
                    <input class="form-check-input" name="no_image" type="checkbox" role="switch" id="no_image">
                    <label class="form-check-label" for="no_image">Nessuna immagine</label>
                </div>
            @endif
            {{-- checkbox no_image --}}
            
            <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture" value="{{ old('picture') }}" onchange="loadFile(event)">
            @error('picture')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- script checkbox no_image --}}
            <script>
                const inputCheckbox = document.getElementById('no_image');
                const inputFile = document.getElementById('picture');
                inputCheckbox.addEventListener('change', function() {
                    if( inputCheckbox.checked ) {
                        inputFile.disabled = true;
                    } else {
                        inputFile.disabled = false;
                    }
                });
            </script>
            {{-- /script checkbox no_image --}}
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipologia</label>
            <select name="type_id" id="type" class="form-select @error('type_id') is-invalid @enderror" aria-label="Default select example">
                <option value="">Nessuna tipologia</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <div class="mb-2">Tecnologie</div>
            @foreach ($technologies as $technology)
                <div class="form-check form-check-inline">
                    {{-- In fase di modifica ottengo 2 tipi di dati diversi, un array in PHP plain nel caso dell'old e una collection di oggetti quando le "technologies" sono associate ai progetti --}}
                    @if( $errors->any() )
                        {{-- in caso di validazione fallita: --}}
                        <input class="form-check-input" type="checkbox" id="{{ $technology->slug }}" name="technologies[]" value="{{ $technology->id }}" {{ in_array( $technology->id, old('technologies', []) ) ? 'checked' : '' }}>
                    @else
                        {{-- per avere già flaggate le eventuali "technologies" già associate: --}}
                        <input class="form-check-input" type="checkbox" id="{{ $technology->slug }}" name="technologies[]" value="{{ $technology->id }}" {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                    @endif
                        <label class="form-check-label" for="{{ $technology->slug }}">{{ $technology->name }}</label>
                </div>
            @endforeach
            @error('technologies')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Modifica</button>
        <button type="reset" class="btn btn-secondary">Pulisci i campi</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-light">Annulla</a>
    </form>
@endsection