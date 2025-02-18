
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Box</h1>
        <div class="mb-4">
            <a href="{{ route('boxes.create') }}" class="btn btn-primary">Ajouter un Box</a>
        </div>
        <div class="row">
            @foreach ($boxes as $box)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $box->name }}</h5>
                            <p class="card-text"><strong>Adresse :</strong> {{ $box->address }}</p>
                            <p class="card-text"><strong>Tarif :</strong> {{ number_format($box->prices, 2, ',', ' ') }} €</p>

                            @php
                                $activeContract = $box->contracts()
                                    ->where('date_start', '<=', now())
                                    ->where('date_end', '>=', now())
                                    ->first();
                            @endphp

                            @if ($activeContract)
                                <div class="alert alert-info p-2">
                                    <strong>Contrat en cours</strong> (ID: {{ $activeContract->id }})<br>
                                    <strong>Locataire :</strong> {{ $activeContract->tenant->name }}
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

                            <a href="{{ route('boxes.show', $box->id) }}" class="btn btn-primary mt-2">Détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
