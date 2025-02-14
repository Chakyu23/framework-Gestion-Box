@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Créer une Box</h2>
        <form action="{{ route('boxes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Adresse</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Prix</label>
                <input type="number" name="prices" class="form-control" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="{{ route('boxes.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
