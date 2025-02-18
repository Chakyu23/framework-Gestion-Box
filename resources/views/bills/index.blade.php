<!-- resources/views/bills/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Factures pour le contrat : {{ $contract->id }}</h1>

        <!-- Informations du contrat -->
        <p><strong>Locataire : </strong>{{ $contract->tenant->name }}</p>
        <p><strong>Box : </strong>{{ $contract->box->name }}</p>
        <p><strong>Modèle de contrat : </strong>{{ $contract->contractModel->name }}</p>
        <p><strong>Prix mensuel : </strong>{{ number_format($contract->monthly_price, 2, ',', ' ') }} €</p>

        <h2>Liste des factures</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Période</th>
                <th>Montant</th>
                <th>Status</th>
                <th>Date de paiement</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contract->bills as $bill)
                @php
                    // Calcul de la période
                    $startDate = new \DateTime($contract->date_start);
                    $startDate->modify('+' . ($bill->periode_number - 1) . ' month');
                    $periodStart = $startDate->format('F Y');
                @endphp
                <tr>
                    <td>{{ $periodStart }}</td>
                    <td>{{ number_format($bill->paiment_amount, 2, ',', ' ') }} €</td>
                    <td>
                        @if($bill->payment_date)
                            ✅ Payée le {{ \Illuminate\Support\Carbon::parse($bill->payment_date)->format('d/m/Y') }}
                        @else
                            ❌ Non payée
                        @endif
                    </td>
                    <td>
                        @if($bill->payment_date)
                            {{ \Carbon\Carbon::parse($bill->payment_date)->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if(!$bill->payment_date)
                            <form action="{{ route('bills.pay', $bill->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success" onclick="return confirm('Confirmer le paiement ?');">
                                    Valider le paiement
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="{{ route('contracts.index') }}" class="btn btn-primary">Retour à la liste des contrats</a>
    </div>
@endsection
