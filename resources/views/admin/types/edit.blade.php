@extends('layouts.admin')

@section('page-title')
    Modifica
@endsection

@section('content')
    <h2 class="text-decoration-underline my-3">Modifica {{ $type->name }}</h2>
    <form action="{{ route('admin.types.update', $type) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome*</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" maxlength="100" value="{{ old('name', $type->name ) }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Modifica</button>
        <button type="reset" class="btn btn-secondary">Pulisci i campi</button>
        <a href="{{ route('admin.types.index') }}" class="btn btn-light">Annulla</a>
    </form>
@endsection