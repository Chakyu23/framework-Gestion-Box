@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Détails du Modèle de Contrat</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $contractModel->name }}</h5>
                <label class="form-label">Contenu du contrat :</label>
                <textarea class="form-control" rows="10" readonly>{{ $contractModel->content }}</textarea>
            </div>
        </div>

        <a href="{{ route('contractModels.index') }}" class="btn btn-secondary mt-3">Retour</a>
        <a href="{{ route('contractModels.edit', $contractModel->id) }}" class="btn btn-primary mt-3">Modifier</a>
    </div>
@endsection
