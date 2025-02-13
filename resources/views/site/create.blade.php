<!-- resources/views/sites/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer un nouveau site</h1>

        <form action="{{ route('sites.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom du site</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="postalCode">Code Postal</label>
                <input type="text" class="form-control @error('postalCode') is-invalid @enderror" id="postalCode" name="postalCode" value="{{ old('postalCode') }}" required>
                @error('postalCode')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="mail">Email</label>
                <input type="email" class="form-control @error('mail') is-invalid @enderror" id="mail" name="mail" value="{{ old('mail') }}" required>
                @error('mail')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="active">Actif</label>
                <select class="form-control @error('active') is-invalid @enderror" id="active" name="active">
                    <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>Oui</option>
                    <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Non</option>
                </select>
                @error('active')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Créer le site</button>
            <a href="{{ route('sites.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
