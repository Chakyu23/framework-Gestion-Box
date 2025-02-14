@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-lg p-4">
            <h3 class="card-title text-center mb-4">Détails du Locataire</h3>
            <div class="card-body">
                <p><strong>Nom :</strong> {{ $tenant->name }}</p>
                <p><strong>Email :</strong> {{ $tenant->email }}</p>
                <p><strong>Téléphone :</strong> {{ $tenant->phone }}</p>
                <p><strong>Adresse :</strong> {{ $tenant->address }}</p>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Retour</a>
                    <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-warning">Modifier</a>

                    <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce locataire ?')">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
