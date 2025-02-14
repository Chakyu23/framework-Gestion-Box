@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Détails du Box - {{ $box->name }}</h2>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $box->name }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Adresse:</strong> {{ $box->address }}</p>
                <p><strong>Prix:</strong> €{{ number_format($box->prices, 2) }}</p>

                @php
                    // Vérification si un contrat est actif pour ce box
                    $isOccupied = false;
                    $currentDate = now();
                    $lastPaymentDate = null;

                    foreach ($box->contracts as $contract) {
                        if ($contract->date_start <= $currentDate && $contract->date_end >= $currentDate && $contract->active) {
                            $isOccupied = true;

                            // Vérification du dernier paiement lié au contrat
                            $latestBill = $contract->bills()->orderBy('periode_number', 'desc')->first();
                            if ($latestBill && $latestBill->payment_date) {
                                $lastPaymentDate = $latestBill->payment_date;
                            }

                            break;
                        }
                    }
                @endphp

                <p class="status">
                    <strong>Status: </strong>
                    <span class="badge
                    @if ($isOccupied)
                        bg-danger
                    @else
                        bg-success
                    @endif
                ">
                    @if ($isOccupied)
                            Occupé
                        @else
                            Disponible
                        @endif
                </span>
                </p>

                @if ($lastPaymentDate)
                    <p class="payment-status">
                        <strong>Dernier paiement:</strong>
                        <span class="badge bg-success">Payé le {{ $lastPaymentDate->format('d/m/Y') }}</span>
                    </p>
                @else
                    <p class="payment-status">
                        <strong>Dernier paiement:</strong>
                        <span class="badge bg-warning">Non payé</span>
                    </p>
                @endif

                <div class="mt-3">
                    <a href="{{ route('boxes.edit', $box->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('boxes.destroy', $box->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce box ?')">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
