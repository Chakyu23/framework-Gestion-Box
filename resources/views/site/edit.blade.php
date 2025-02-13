<!-- resources/views/sites/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le site : {{ $site->name }}</h1>

        <form action="{{ route('sites.update', $site) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom du site</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $site->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $site->address) }}" required>
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="postalCode">Code Postal</label>
                <input type="text" class="form-control @error('postalCode') is-invalid @enderror" id="postalCode" name="postalCode" value="{{ old('postalCode', $site->postalCode) }}" required>
                @error('postalCode')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone', $site->telephone) }}" required>
                @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="mail">Email</label>
                <input type="email" class="form-control @error('mail') is-invalid @enderror" id="mail" name="mail" value="{{ old('mail', $site->mail) }}" required>
                @error('mail')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="active">Actif</label>
                <select class="form-control @error('active') is-invalid @enderror" id="active" name="active">
                    <option value="1" {{ old('active', $site->active) == '1' ? 'selected' : '' }}>Oui</option>
                    <option value="0" {{ old('active', $site->active) == '0' ? 'selected' : '' }}>Non</option>
                </select>
                @error('active')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-warning">Mettre à jour</button>
            <a href="{{ route('sites.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
