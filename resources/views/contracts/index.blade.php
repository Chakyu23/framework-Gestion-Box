@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Liste des Contrats</h2>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Locataire</th>
                        <th>Box</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Loyer Mensuel</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contracts as $contract)
                        <tr>
                            <td>{{ $contract->id }}</td>
                            <td>{{ $contract->tenant->name }}</td>
                            <td>{{ $contract->box->name }}</td>
                            <td>{{ $contract->date_start }}</td>
                            <td>{{ $contract->date_end }}</td>
                            <td>{{ number_format($contract->monthly_price, 2) }} €</td>
                            <td>
                                <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('contracts.create') }}" class="btn btn-success">Créer un contrat</a>
            </div>
        </div>
    </div>
@endsection
