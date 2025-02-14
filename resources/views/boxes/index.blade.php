@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Liste des Box</h2>

        <div class="mb-4">
            <a href="{{ route('boxes.create') }}" class="btn btn-primary">Ajouter un Box</a>
        </div>

        <div class="row">
            @foreach ($boxes as $box)
                <div class="col-md-4 mb-3">
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

                            <a href="{{ route('boxes.show', $box->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('boxes.edit', $box->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('boxes.destroy', $box->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce box ?')">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
