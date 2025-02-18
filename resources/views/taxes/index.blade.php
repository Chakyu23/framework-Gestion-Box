@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Gestion des Impôts</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Résumé Fiscal</h5>
                <p><strong>Revenu Annuel Total :</strong> {{ number_format($revenuAnnuel, 2, ',', ' ') }} €</p>

                @if($revenuAnnuel <= 15000)
                    <p><strong>Régime :</strong> Micro-foncier</p>
                    <p><strong>Case de déclaration :</strong> 4BE (déclaration 2042)</p>
                    <p><strong>Montant imposable :</strong> {{ number_format($revenuAnnuel * 0.7, 2, ',', ' ') }} € (abattement de 30%)</p>
                @else
                    <p><strong>Régime :</strong> Réel</p>
                    <p><strong>Case de déclaration :</strong> 4BA (déclaration 2044)</p>
                    <p><strong>Montant imposable :</strong> {{ number_format($revenuAnnuel, 2, ',', ' ') }} €</p>
                @endif
            </div>
        </div>
    </div>
@endsection
