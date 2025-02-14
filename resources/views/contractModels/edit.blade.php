@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Modifier le Modèle de Contrat</h2>

        <form action="{{ route('contractModels.update', $contractModel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom du Modèle</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $contractModel->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenu du Modèle</label>
                <div id="editorjs"></div>
                <textarea name="content" id="content" style="display: none;"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Mots-clés disponibles :</label>
                <div class="list-group">
                    <span class="list-group-item">%nomClient% : Le nom du client</span>
                    <span class="list-group-item">%LoyerMensuel% : Le montant du loyer mensuel</span>
                    <span class="list-group-item">%dateDebut% : La date de début du contrat</span>
                    <!-- Ajoutez ici les autres mots-clés si nécessaire -->
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Sauvegarder</button>
            <a href="{{ route('contractModels.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.22.0/dist/editor.js"></script>
        <script>
            const editor = new EditorJS({
                holder: 'editorjs',
                data: {!! json_encode($contractModel->content ? json_decode($contractModel->content) : []) !!},
                onChange: (api, event) => {
                    editor.save().then((outputData) => {
                        document.getElementById('content').value = JSON.stringify(outputData);
                    });
                }
            });
        </script>
    @endsection
@endsection
