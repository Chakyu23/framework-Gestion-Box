@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Sites</h1>
        <a href="{{ route('sites.create') }}" class="btn btn-primary mb-3">Ajouter un site</a>

        <div class="list-group">
            @foreach($sites as $site)
                <div class="list-group-item">
                    <h5 class="mb-1">{{ $site->name }}</h5>
                    <p class="mb-1">{{ $site->address }} - {{ $site->postalCode }} - {{ $site->city }}</p>
                    <p>{{ $site->telephone }} - {{ $site->mail }}</p>
                    <a href="{{ route('sites.show', $site) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('sites.edit', $site) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('sites.destroy', $site) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
