@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Facture #{{ $bill->periode_number }}</h1>
        <p><strong>Contrat :</strong> {{ $bill->contract->id }}</p>
        <p><strong>Date de paiement :</strong> {{ $bill->payment_date ? $bill->payment_date->format('d/m/Y') : 'Non réglée' }}</p>
        <p><strong>Montant :</strong> {{ number_format($bill->paiment_amount, 2, ',', ' ') }} €</p>
        <p><strong>Statut :</strong>
            @if ($bill->payment_date)
                <span class="badge bg-success">Réglée</span>
            @else
                <span class="badge bg-danger">Non réglée</span>
            @endif
        </p>

        <a href="{{ route('bills.edit', $bill->id) }}" class="btn btn-warning">Modifier la Facture</a>
        <a href="{{ route('contracts.show', $bill->contract->id) }}" class="btn btn-info">Retour au Contrat</a>
    </div>
@endsection
