<!-- resources/views/contracts/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des contrats</h1>
        <!-- Bouton pour créer un nouveau contrat -->
        <a href="{{ route('contracts.create') }}" class="btn btn-primary mb-4">Créer un Nouveau Contrat</a>

        <!-- Bouton pour générer les factures pour ce mois -->
        <form action="{{ route('contracts.generateBills') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-success">Générer les Factures pour ce Mois</button>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th>ID du contrat</th>
                <th>Locataire</th>
                <th>Modèle de contrat</th>
                <th>Box</th>
                <th>Prix Mensuel</th>
                <th>Factures</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contracts as $contract)
                <tr>
                    <td>{{ $contract->id }}</td>
                    <td>{{ $contract->tenant->name }}</td>
                    <td>{{ $contract->contractModel->name }}</td>
                    <td>{{ $contract->box->name }}</td>
                    <td>{{ number_format($contract->monthly_price, 2, ',', ' ') }} €</td>
                    <td>
                        <!-- Si le contrat a des factures, afficher le bouton -->
                        @if($contract->bills->isEmpty())
                            <span>Aucune facture</span>
                        @else
                            <a href="{{ route('bills.index', $contract->id) }}" class="btn btn-info">Voir les factures</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-info">Détails</a>
                        <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('contracts.create') }}" class="btn btn-primary">Créer un contrat</a>
    </div>
@endsection
