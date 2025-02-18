<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impôts - PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table, .table th, .table td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
<h2>Résumé de la déclaration fiscale</h2>
<table class="table">
    <tr>
        <th>Revenu Annuel</th>
        <td>{{ number_format($revenuAnnuel, 2, ',', ' ') }} €</td>
    </tr>
    <tr>
        <th>Régime</th>
        <td>{{ $regime }}</td>
    </tr>
    <tr>
        <th>Case de déclaration</th>
        <td>{{ $caseDeclaration }}</td>
    </tr>
    <tr>
        <th>Montant déclaré</th>
        <td>{{ number_format($montantDeclare, 2, ',', ' ') }} €</td>
    </tr>
    <tr>
        <th>Montant imposable</th>
        <td>{{ number_format($montantImposable, 2, ',', ' ') }} €</td>
    </tr>
</table>
</body>
</html>
