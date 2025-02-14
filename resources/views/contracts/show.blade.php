@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Détails du Contrat #{{ $contract->id }}</h2>

        <div class="card">
            <div class="card-body">
                <h4>Locataire : {{ $contract->tenant->name }}</h4>
                <h5>Box : {{ $contract->box->name }}</h5>
                <p><strong>Date de début :</strong> {{ $contract->date_start }}</p>
                <p><strong>Date de fin :</strong> {{ $contract->date_end }}</p>
                <p><strong>Loyer Mensuel :</strong> {{ number_format($contract->monthly_price, 2) }} €</p>
                <p><strong>Modèle de contrat utilisé :</strong> {{ $contract->contractModel->name }}</p>

                <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-warning">Modifier</a>
                <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
@endsection
