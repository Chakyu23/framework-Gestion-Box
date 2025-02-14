@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier un Locataire</h2>
        <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" value="{{ $tenant->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $tenant->email }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="phone" class="form-control" value="{{ $tenant->phone }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Adresse</label>
                <input type="text" name="address" class="form-control" value="{{ $tenant->address }}" required>
            </div>
            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
