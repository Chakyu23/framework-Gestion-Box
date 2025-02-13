@extends('layouts.app')

@section('title', 'Ajouter un Locataire')

@section('content')
    <div class="container">
        <h1>Ajouter un Locataire</h1>
        <form method="POST" action="{{ route('locataires.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" class="form-control" name="firstname" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" name="lastname" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" class="form-control" name="telephone" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="mail" required>
            </div>
            <div class="mb-3">
                <label class="form-label">IBAN</label>
                <input type="text" class="form-control" name="IBAN">
            </div>
            <div class="mb-3">
                <label class="form-label">Adresse</label>
                <input type="text" class="form-control" name="adresse" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Code Postal</label>
                <input type="text" class="form-control" name="postalCode" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ville</label>
                <input type="text" class="form-control" name="city" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Actif</label>
                <input type="checkbox" name="active" value="1">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
