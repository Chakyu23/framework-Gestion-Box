<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Déclaration des Impôts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        .details {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h1>Déclaration des Impôts</h1>
<div class="details">
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
</body>
</html>
