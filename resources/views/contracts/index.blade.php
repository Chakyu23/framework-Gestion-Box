@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Contrats</h1>

        <!-- Bouton pour créer un nouveau contrat -->
        <a href="{{ route('contracts.create') }}" class="btn btn-primary mb-4">Créer un Nouveau Contrat</a>

        <!-- Bouton pour générer les factures pour ce mois -->
        <form action="{{ route('contracts.generateBills') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-success">Générer les Factures pour ce Mois</button>
        </form>

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
                <th>Factures</th>
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
                        <!-- Toggle button to show/hide bills -->
                        <button class="btn btn-info btn-sm" onclick="toggleBills({{ $contract->id }})">
                            {{ $contract->bills->isEmpty() ? 'Aucune Facture' : 'Voir Factures' }}
                        </button>
                        <div id="bills-{{ $contract->id }}" class="mt-2" style="display: none;">
                            <ul class="list-group">
                                @foreach ($contract->bills as $bill)
                                    @php
                                        // Conversion de 'date_start' en DateTime
                                            $startDate = new \DateTime($contract->date_start);

                                            // Ajouter les mois correspondant à la période
                                            $startDate->modify('+' . ($bill->periode_number - 1) . ' month');

                                            // Formater la date pour afficher mois et année
                                            $period = $startDate->format('F Y');
                                    @endphp
                                    <li class="list-group-item">
                                        <strong>Période :</strong> {{ $period }} <br>
                                        <strong>Valeur :</strong> {{ number_format($bill->paiment_amount, 2, ',', ' ') }} € <br>
                                        @if ($bill->is_paid)
                                            <span class="text-success"><strong>Payé</strong></span><br>
                                            <strong>Date de Paiement :</strong> {{ $bill->payment_date }}
                                        @else
                                            <span class="text-danger"><strong>Non payé</strong></span><br>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Fonction pour afficher ou masquer les factures d'un contrat
        function toggleBills(contractId) {
            var billRow = document.getElementById('bills-' + contractId);
            if (billRow.style.display === 'none' || billRow.style.display === '') {
                billRow.style.display = 'block';  // Afficher les factures
            } else {
                billRow.style.display = 'none';   // Masquer les factures
            }
        }
    </script>
@endsection
