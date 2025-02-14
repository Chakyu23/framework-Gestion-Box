@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Modifier le Contrat</h2>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('contracts.update', $contract->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="tenant_id" class="form-label">Locataire</label>
                        <select class="form-control" id="tenant_id" name="tenant_id" required>
                            @foreach($tenants as $tenant)
                                <option value="{{ $tenant->id }}" {{ $contract->tenant_id == $tenant->id ? 'selected' : '' }}>
                                    {{ $tenant->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="box_id" class="form-label">Box</label>
                        <select class="form-control" id="box_id" name="box_id" required>
                            @foreach($boxes as $box)
                                <option value="{{ $box->id }}" {{ $contract->box_id == $box->id ? 'selected' : '' }}>
                                    {{ $box->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
