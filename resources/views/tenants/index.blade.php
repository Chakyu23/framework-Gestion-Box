@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Liste des Locataires</h2>
        <a href="{{ route('tenants.create') }}" class="btn btn-primary mb-3">Ajouter un Locataire</a>

        <div class="row g-3">
            @foreach ($tenants as $tenant)
                <div class="col-md-4">
                    <div class="card p-3 shadow-sm">
                        <h5>{{ $tenant->name }}</h5>
                        <p>Email : {{ $tenant->email }}</p>
                        <p>Téléphone : {{ $tenant->phone }}</p>
                        <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" class="d-inline">
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
