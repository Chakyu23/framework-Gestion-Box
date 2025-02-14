<!-- resources/views/edit_locataire.blade.php -->

@extends('layouts.app') <!-- Assurez-vous que vous avez une mise en page de base -->

@section('content')
    <div class="container">
        <h2>Modifier le Locataire</h2>

        <form action="{{ route('locataire.update', $locataire->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Prénom -->
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" value="{{ old('firstname', $locataire->firstname) }}" class="form-control @error('firstname') is-invalid @enderror" required>
                @error('firstname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nom -->
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $locataire->lastname) }}" class="form-control @error('lastname') is-invalid @enderror" required>
                @error('lastname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Téléphone -->
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $locataire->telephone) }}" class="form-control @error('telephone') is-invalid @enderror" required>
                @error('telephone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="mail">Email</label>
                <input type="email" id="mail" name="mail" value="{{ old('mail', $locataire->mail) }}" class="form-control @error('mail') is-invalid @enderror" required>
                @error('mail')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- IBAN -->
            <div class="form-group">
                <label for="IBAN">IBAN</label>
                <input type="text" id="IBAN" name="IBAN" value="{{ old('IBAN', $locataire->IBAN) }}" class="form-control @error('IBAN') is-invalid @enderror">
                @error('IBAN')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Adresse -->
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $locataire->adresse) }}" class="form-control @error('adresse') is-invalid @enderror" required>
                @error('adresse')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Code Postal -->
            <div class="form-group">
                <label for="postalCode">Code Postal</label>
                <input type="text" id="postalCode" name="postalCode" value="{{ old('postalCode', $locataire->postalCode) }}" class="form-control @error('postalCode') is-invalid @enderror" required>
                @error('postalCode')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Ville -->
            <div class="form-group">
                <label for="city">Ville</label>
                <input type="text" id="city" name="city" value="{{ old('city', $locataire->city) }}" class="form-control @error('city') is-invalid @enderror" required>
                @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Actif -->
            <div class="form-group form-check">
                <input type="checkbox" id="active" name="active" value="1" class="form-check-input @error('active') is-invalid @enderror" {{ old('active', $locataire->active) ? 'checked' : '' }}>
                <label for="active" class="form-check-label">Actif</label>
                @error('active')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
