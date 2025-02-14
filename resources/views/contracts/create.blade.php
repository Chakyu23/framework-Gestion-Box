@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Créer un Nouveau Contrat</h2>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('contracts.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="tenant_id" class="form-label">Locataire</label>
                        <select class="form-control" id="tenant_id" name="tenant_id" required>
                            @foreach($tenants as $tenant)
                                <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="box_id" class="form-label">Box</label>
                        <select class="form-control" id="box_id" name="box_id" required>
                            @foreach($boxes as $box)
                                <option value="{{ $box->id }}">{{ $box->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="contract_model_id" class="form-label">Modèle de Contrat</label>
                        <select class="form-control" id="contract_model_id" name="contract_model_id" required>
                            @foreach($contractModels as $contractModel)
                                <option value="{{ $contractModel->id }}">{{ $contractModel->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="date_start" class="form-label">Date de début</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" required>
                    </div>

                    <div class="mb-3">
                        <label for="date_end" class="form-label">Date de fin</label>
                        <input type="date" class="form-control" id="date_end" name="date_end" required>
                    </div>

                    <div class="mb-3">
                        <label for="monthly_price" class="form-label">Loyer Mensuel (€)</label>
                        <input type="number" step="0.01" class="form-control" id="monthly_price" name="monthly_price" required>
                    </div>

                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
