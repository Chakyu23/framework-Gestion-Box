@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier la Facture #{{ $bill->periode_number }}</h1>

        <form action="{{ route('bills.update', $bill->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="payment_date" class="form-label">Date de Paiement</label>
                <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date', $bill->payment_date ? $bill->payment_date->format('Y-m-d') : '') }}">
                @error('payment_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="paiment_amount" class="form-label">Montant Payé</label>
                <input type="number" step="0.01" class="form-control @error('paiment_amount') is-invalid @enderror" id="paiment_amount" name="paiment_amount" value="{{ old('paiment_amount', $bill->paiment_amount) }}">
                @error('paiment_amount')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Mettre à Jour</button>
        </form>

        <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-secondary mt-3">Retour à la Facture</a>
    </div>
@endsection
