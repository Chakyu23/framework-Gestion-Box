<!-- resources/views/sites/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $site->name }}</h1>
        <p><strong>Adresse:</strong> {{ $site->address }}</p>
        <p><strong>Code Postal:</strong> {{ $site->postalCode }}</p>
        <p><strong>Téléphone:</strong> {{ $site->telephone }}</p>
        <p><strong>Email:</strong> {{ $site->mail }}</p>
        <p><strong>Ville:</strong> {{ $site->city }}</p>
        <p><strong>Statut:</strong> {{ $site->active ? 'Actif' : 'Inactif' }}</p>

        <a href="{{ route('sites.index') }}" class="btn btn-secondary">Retour à la liste</a>
        <a href="{{ route('sites.edit', $site) }}" class="btn btn-warning">Modifier</a>
    </div>
@endsection
