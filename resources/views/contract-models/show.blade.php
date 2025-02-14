@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Détails du Modèle de Contrat</h2>

        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title">Nom du Modèle : {{ $contractModel->name }}</h5>

                <div class="mb-3">
                    <label for="content" class="form-label">Contenu du Modèle</label>
                    <div id="content-display" class="border p-3" style="min-height: 300px;">
                        {!! $contractModel->content ? renderEditorJsContent($contractModel->content) : 'Aucun contenu disponible' !!}
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('contract-models.index') }}" class="btn btn-secondary">Retour</a>
                    <a href="{{ route('contract-models.edit', $contractModel->id) }}" class="btn btn-warning">Modifier</a>

                    <form action="{{ route('contract-models.destroy', $contractModel->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce modèle ?')">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Si nécessaire, ajoutez un script pour gérer l'affichage du contenu si c'est nécessaire
    </script>
@endsection
