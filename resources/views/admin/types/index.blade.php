@extends('layouts.admin')

@section('page-title')
    Tipologie
@endsection

@section('content')
    <h2 class="text-decoration-underline my-3">Lista tipologie</h2>
    @include('partials.message')
    <a href="{{ route('admin.types.create') }}" class="btn btn-light my-3"><i class="fa-regular fa-square-plus me-2"></i>Aggiungi tipologia</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Slug</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>
                <td>{{ $type->id }}</td>
                <td>{{ $type->name }}</td>
                <td>{{ $type->slug }}</td>
                <td>
                    <a href="{{ route('admin.types.show', $type) }}" class="btn btn-light"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-light"><i class="fa-solid fa-pen-to-square"></i></a>

                    <!-- Button modale (modalDelete) -->
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $type->id }}"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>

            <!-- Modale (modalDelete) -->
            <div class="modal fade" id="modalDelete-{{ $type->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalDeleteLabel">Cancellazione elemento</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Confermi di voler cancellare definitivamente la tipologia "<strong>{{ $type->name }}</strong>"?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <form action="{{ route('admin.types.destroy', $type)}}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Sì, cancella</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
@endsection