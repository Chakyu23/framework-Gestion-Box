@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Contrats</h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Locataire</th>
                <th>Modèle de Contrat</th>
                <th>Box</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Prix Mensuel</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($contracts as $contract)
                <tr>
                    <td>{{ $contract->id }}</td>
                    <td>{{ $contract->tenant->name }}</td>
                    <td>{{ $contract->contractModel->name }}</td>
                    <td>{{ $contract->box->name }}</td>
                    <td>{{ $contract->date_start }}</td>
                    <td>{{ $contract->date_end }}</td>
                    <td>{{ number_format($contract->monthly_price, 2, ',', ' ') }} €</td>
                    <td>
                        <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')">Supprimer</button>
                        </form>
                        <button class="btn btn-secondary btn-sm" onclick="toggleFactures({{ $contract->id }})">Afficher les Factures</button>
                    </td>
                </tr>
                <tr class="factures" id="factures-{{ $contract->id }}" style="display: none;">
                    <td colspan="8">
                        <h5>Factures :</h5>
                        <ul class="list-group">
                            @foreach ($contract->bills as $bill)
                                <li class="list-group-item">
                                    <strong>Facture {{ $bill->periode_number }}</strong> -
                                    Date de paiement : {{ $bill->payment_date ? $bill->payment_date->format('d/m/Y') : 'Non réglée' }} -
                                    Montant : {{ number_format($bill->paiment_amount, 2, ',', ' ') }} €
                                    @if (!$bill->payment_date)
                                        <span class="badge bg-danger">Non réglée</span>
                                    @else
                                        <span class="badge bg-success">Réglée</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Script pour afficher/masquer les factures au clic
        function toggleFactures(contractId) {
            const facturesRow = document.getElementById(`factures-${contractId}`);
            facturesRow.style.display = (facturesRow.style.display === 'none') ? 'table-row' : 'none';
        }
    </script>
@endsection
