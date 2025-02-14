@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Créer un Locataire</h2>
        <form action="{{ route('tenants.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Adresse</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
