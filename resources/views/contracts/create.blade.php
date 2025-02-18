@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Créer un contrat</h2>
        <form action="{{ route('contracts.store') }}" method="POST">
            @csrf

            <!-- Sélection du locataire -->
            <div class="mb-3">
                <label for="tenant_id" class="form-label">Locataire</label>
                <select id="tenant_id" name="tenant_id" class="form-select">
                    <option value="" disabled selected>Choisir un locataire</option>
                    @foreach ($tenants as $tenant)
                        <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection du box -->
            <div class="mb-3">
                <label for="box_id" class="form-label">Box</label>
                <select id="box_id" name="box_id" class="form-select">
                    <option value="" disabled selected>Choisir un box</option>
                    @foreach ($boxes as $box)
                        <option value="{{ $box->id }}" data-price="{{ $box->prices }}">{{ $box->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Prix mensuel (auto rempli) -->
            <div class="mb-3">
                <label for="monthly_price" class="form-label">Prix mensuel (€)</label>
                <input type="number" id="monthly_price" name="monthly_price" class="form-control" readonly>
            </div>

            <!-- Sélection du modèle de contrat -->
            <div class="mb-3">
                <label for="contract_model_id" class="form-label">Modèle de contrat</label>
                <select id="contract_model_id" name="contract_model_id" class="form-select">
                    <option value="" disabled selected>Choisir un modèle de contrat</option>
                    @foreach ($contractModels as $model)
                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Date de début (préremplie au 1er du mois prochain) -->
            <div class="mb-3">
                <label for="date_start" class="form-label">Date de début</label>
                <input type="date" id="date_start" name="date_start" class="form-control" required>
            </div>

            <!-- Date de fin (préremplie +3 ans après la date de début) -->
            <div class="mb-3">
                <label for="date_end" class="form-label">Date de fin</label>
                <input type="date" id="date_end" name="date_end" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function formatDate(date) {
                let year = date.getFullYear();
                let month = String(date.getMonth() + 1).padStart(2, '0'); // Mois sur 2 chiffres
                let day = String(date.getDate()).padStart(2, '0'); // Jour sur 2 chiffres
                return `${year}-${month}-${day}`;
            }

            function getFirstOfNextMonth() {
                let today = new Date();
                let year = today.getFullYear();
                let month = today.getMonth() + 1; // Mois suivant (0-indexed)
                if (month === 12) { // Si décembre, passer à janvier de l'année suivante
                    month = 0;
                    year += 1;
                }

                return formatDate(new Date(year, month, 1))
            }

            function updateEndDate() {
                let startDate = document.getElementById("date_start").valueAsDate;
                if (!startDate) return;

                let endDate = new Date(startDate);
                endDate.setFullYear(endDate.getFullYear() + 3);

                document.getElementById("date_end").value = formatDate(endDate);
            }

            // Définir la date de début au 1er du mois prochain
            let dateStartInput = document.getElementById("date_start");
            dateStartInput.value = getFirstOfNextMonth();

            // Mettre à jour la date de fin automatiquement
            updateEndDate();

            // Mettre à jour le prix mensuel en fonction du Box sélectionné
            document.getElementById("box_id").addEventListener("change", function() {
                let selectedOption = this.options[this.selectedIndex];
                let price = selectedOption.getAttribute("data-price");
                document.getElementById("monthly_price").value = price;
            });
        });
    </script>

@endsection
