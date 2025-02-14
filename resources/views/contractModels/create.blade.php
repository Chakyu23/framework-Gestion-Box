@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Créer un Modèle de Contrat</h2>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('contractModels.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du Modèle</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenu du contrat</label>
                        <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <a href="{{ route('contractModels.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
