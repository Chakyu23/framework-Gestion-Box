<?php

namespace App\Http\Controllers;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaxController extends Controller
{
    /**
     * Afficher la page de gestion des impôts.
     */
    public function index()
    {
        $user = Auth::user();

        // Récupérer le total des revenus des contrats de l'utilisateur
        $revenuAnnuel = $user->contracts()->sum('monthly_price') * 12;

        return view('taxes.index', compact('revenuAnnuel'));
    }

    /**
     * Générer un PDF des informations fiscales avec DomPDF.
     */
    public function generatePdf()
    {
        $user = Auth::user();

        // Calcul du revenu annuel
        $revenuAnnuel = $user->contracts()->sum('monthly_price') * 12;

        // Déterminer le régime fiscal
        if ($revenuAnnuel <= 15000) {
            $regime = "Micro-foncier";
            $caseDeclaration = "4BE (déclaration 2042)";
            $montantDeclare = $revenuAnnuel;
            $montantImposable = $revenuAnnuel * 0.7; // Abattement de 30%
        } else {
            $regime = "Réel";
            $caseDeclaration = "4BA (déclaration 2044)";
            $montantDeclare = $revenuAnnuel;
            $montantImposable = $revenuAnnuel; // 100% imposable
        }

        $data = compact('revenuAnnuel', 'regime', 'caseDeclaration', 'montantDeclare', 'montantImposable');

        // Générer le PDF avec DomPDF
        $pdf = PDF::loadView('pdf.taxes', $data);

        // Télécharger le fichier PDF
        return $pdf->download('taxes.pdf');
    }
}

