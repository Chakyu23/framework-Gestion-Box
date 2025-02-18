@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Contrat #{{ $contract->id }}</h1>

        <div class="card">
            <div class="card-header">
                <strong>Informations du Contrat</strong>
            </div>
            <div class="card-body">
                <p><strong>Date de début :</strong> {{ $contract->date_start }}</p>
                <p><strong>Date de fin :</strong> {{ $contract->date_end }}</p>
                <p><strong>Prix mensuel :</strong> {{ number_format($contract->monthly_price, 2, ',', ' ') }} €</p>
                <p><strong>Locataire :</strong> {{ $contract->tenant->name }} ({{ $contract->tenant->email }})</p>
                <p><strong>Box :</strong> {{ $contract->box->name }} - {{ $contract->box->address }}</p>
            </div>
        </div>

        <h2 class="mt-4">Contenu du contrat</h2>
        <div class="border p-3 bg-light">
            {!! nl2br(e($contractContent)) !!}
        </div>

        <a href="{{ route('contracts.index') }}" class="btn btn-primary mt-3">Retour</a>
    </div>
@endsection
