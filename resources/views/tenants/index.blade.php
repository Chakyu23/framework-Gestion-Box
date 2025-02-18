@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Locataires</h1>

        <div class="row">
            @foreach ($tenants as $tenant)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tenant->name }}</h5>
                            <p class="card-text"><strong>Email :</strong> {{ $tenant->email }}</p>
                            <p class="card-text"><strong>Téléphone :</strong> {{ $tenant->phone }}</p>
                            <p class="card-text"><strong>Adresse :</strong> {{ $tenant->address }}</p>

                            @php
                                $activeContract = $tenant->contracts()
                                    ->where('date_start', '<=', now())
                                    ->where('date_end', '>=', now())
                                    ->first();
                            @endphp

                            @if ($activeContract)
                                <div class="alert alert-info p-2">
                                    📜 <strong>Contrat en cours</strong> (ID: {{ $activeContract->id }})<br>
                                    📦 <strong>Box :</strong> {{ $activeContract->box->name }}
                                </div>

                                @php
                                    $unpaidBills = $activeContract->bills()->whereNull('payment_date')->count();
                                @endphp

                                @if ($unpaidBills > 0)
                                    <div class="alert alert-danger p-2">
                                        🚨 <strong>{{ $unpaidBills }} facture(s) impayée(s) !</strong>
                                    </div>
                                @else
                                    <div class="alert alert-success p-2">
                                        ✅ Toutes les factures sont payées.
                                    </div>
                                @endif
                            @else
                                <div class="alert alert-secondary p-2">
                                    Aucun contrat en cours.
                                </div>
                            @endif

                            <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-primary mt-2">Détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('contracts.index') }}" class="btn btn-secondary mt-3">Retour aux contrats</a>
    </div>
@endsection
