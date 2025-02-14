@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Modifier le Modèle de Contrat</h2>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('contractModels.update', $contractModel->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du Modèle</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $contractModel->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenu du contrat</label>
                        <textarea class="form-control" id="content" name="content" rows="10" required>{{ $contractModel->content }}</textarea>
                    </div>

                    <div class="mb-3">
                        <h5>Variables utilisables :</h5>
                        <ul class="list-group">
                            <li class="list-group-item">%nomClient%</li>
                            <li class="list-group-item">%adresseClient%</li>
                            <li class="list-group-item">%telephoneClient%</li>
                            <li class="list-group-item">%emailClient%</li>
                            <li class="list-group-item">%dateDebutContrat%</li>
                            <li class="list-group-item">%dateFinContrat%</li>
                            <li class="list-group-item">%loyerMensuel%</li>
                        </ul>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('contractModels.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
