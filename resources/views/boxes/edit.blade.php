@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier la Box</h2>
        <form action="{{ route('boxes.update', $box->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" value="{{ $box->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Adresse</label>
                <input type="text" name="address" class="form-control" value="{{ $box->address }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Prix</label>
                <input type="number" name="prices" class="form-control" step="0.01" value="{{ $box->prices }}" required>
            </div>
            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('boxes.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
