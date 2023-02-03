@extends('layouts.admin')

@section('page-title')
    Crea
@endsection

@section('content')
    <h2 class="text-decoration-underline my-3">Crea progetto</h2>
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titolo*</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" maxlength="150" value="{{ old('title') }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="customer" class="form-label">Cliente*</label>
            <input type="text" class="form-control @error('customer') is-invalid @enderror" id="customer" name="customer" maxlength="100" value="{{ old('customer') }}">
            @error('customer')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Immagine</label>
            
            {{-- preview immagine caricata --}}
            <div>
                <img id="preview" width="150" class="img-fluid mb-3"/>
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

            <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture" value="{{ old('picture') }}" onchange="loadFile(event)">
            @error('picture')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipologia</label>
            <select name="type_id" id="type" class="form-select @error('type_id') is-invalid @enderror" aria-label="Default select example">
                <option value="">Nessuna tipologia</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
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
                <input class="form-check-input @error('technologies') is-invalid @enderror" type="checkbox" id="{{ $technology->slug }}" name="technologies[]" value="{{ $technology->id }}" {{ in_array( $technology->id, old('technologies', []) ) ? 'checked' : ''}}>
                <label class="form-check-label" for="{{ $technology->slug }}">{{ $technology->name }}</label>
            </div>
            @endforeach
            @error('technologies')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crea</button>
        <button type="reset" class="btn btn-secondary">Pulisci i campi</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-light">Annulla</a>
    </form>
@endsection