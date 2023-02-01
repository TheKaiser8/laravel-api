@extends('layouts.admin')

@section('page-title')
    Dettagli
@endsection

@section('content')
    <h2 class="text-decoration-underline my-3">Dettagli tipologia: {{ $type->name }}</h2>
    @if( count($type->projects) > 0)
        <h3 class="my-3">Progetti associati:</h3>
        @foreach ($type->projects as $project)
            <a href="{{ route('admin.projects.show', $project) }}" class="text-decoration-none">
                <div class="card my-3">
                    <div class="card-body">
                        <h4 class="card-title fw-bold">{{ $project->title }}</h4>
                        <h5 class="card-subtitle mb-2 text-muted">{{ $project->slug }}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    @else
        <h3>Nessun progetto associato</h3>
    @endif
    <a href="{{ route('admin.types.index') }}" class="btn btn-secondary my-3">Torna alle tipologie</a>
@endsection