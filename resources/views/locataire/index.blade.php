@extends('layouts.app')

@section('title', 'Liste des Locataires')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Locataires</h1>
        <a href="{{ route('locataire.create') }}" class="btn btn-success mb-3">Ajouter un Locataire</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Code Postal</th>
                <th>Ville</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($locataires as $locataire)
                <tr>
                    <td>{{ $locataire->firstname }}</td>
                    <td>{{ $locataire->lastname }}</td>
                    <td>{{ $locataire->telephone }}</td>
                    <td>{{ $locataire->postalCode }}</td>
                    <td>{{ $locataire->city }}</td>
                    <td>
                        <a href="{{ route('locataire.show', $locataire->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('locataire.edit', $locataire->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('locataire.destroy', $locataire->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce locataire ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
