@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Modèles de Contrat</h2>
        <a href="{{ route('contractModels.create') }}" class="btn btn-primary mb-3">Ajouter un Modèle</a>

        <div class="row g-3">
            @foreach ($contractModels as $contractModel)
                <div class="col-md-4">
                    <div class="card p-3 shadow-sm">
                        <h5>{{ $contractModel->name }}</h5>
                        <p>Créé par : {{ $contractModel->owner->name }}</p>
                        <a href="{{ route('contractModels.show', $contractModel->id) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('contractModels.edit', $contractModel->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('contractModels.destroy', $contractModel->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
