<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BillController extends Controller
{
    use AuthorizesRequests;

    /**
     * Afficher la liste des factures
     */
    public function index(int $contractId)
    {
        // Récupérer le contrat avec ses factures
        $contract = Contract::with('bills')->findOrFail($contractId);

        // Passer le contrat et ses factures à la vue
        return view('bills.index', compact('contract'));
    }

    /**
     * Afficher le formulaire de création d'une facture
     */
    public function create()
    {
        $contracts = Contract::where('owner_id', Auth::id())->get();

        return view('bills.create', compact('contracts'));
    }

    /**
     * Stocker une nouvelle facture
     */
    public function store(Request $request)
    {
        $request->validate([
            'periode_number' => 'required|integer',
            'payment_date' => 'required|date',
            'paiment_amount' => 'required|numeric',
            'contract_id' => 'required|exists:contracts,id',
        ]);

        Bill::create(array_merge($request->all(), ['owner_id' => Auth::id()]));

        return redirect()->route('bills.index')->with('success', 'Facture ajoutée avec succès');
    }

    /**
     * Afficher les détails d'une facture
     */
    public function show(Bill $bill)
    {
        $this->authorize('view', $bill);

        return view('bills.show', compact('bill'));
    }

    /**
     * Afficher le formulaire d'édition d'une facture
     */
    public function edit(Bill $bill)
    {
        $this->authorize('update', $bill);

        $contracts = Contract::where('owner_id', Auth::id())->get();

        return view('bills.edit', compact('bill', 'contracts'));
    }

    /**
     * Mettre à jour une facture
     */
    public function update(Request $request, Bill $bill)
    {
        $this->authorize('update', $bill);

        $request->validate([
            'periode_number' => 'required|integer',
            'payment_date' => 'required|date',
            'paiment_amount' => 'required|numeric',
            'contract_id' => 'required|exists:contracts,id',
        ]);

        $bill->update($request->all());

        return redirect()->route('bills.index')->with('success', 'Facture mise à jour');
    }

    /**
     * Supprimer une facture
     */
    public function destroy(Bill $bill)
    {
        $this->authorize('delete', $bill);

        $bill->delete();

        return redirect()->route('bills.index')->with('success', 'Facture supprimée');
    }

    public function generateBills()
    {
        // Récupérer la date actuelle
        $currentDate = Carbon::now();

        // Récupérer tous les contrats actifs (en cours)
        $contracts = Contract::where('date_start', '<=', $currentDate)
            ->where('date_end', '>=', $currentDate)
            ->get();

        // Parcourir chaque contrat pour générer une facture
        foreach ($contracts as $contract) {

            // Calculer la période actuelle en fonction de la date de début
            $startDate = new \DateTime($contract->date_start);
            $monthsElapsed = $startDate->diff($currentDate)->m + ($startDate->diff($currentDate)->y * 12); // Calcul du nombre de mois depuis la date de début

            // Vérifier si une facture existe déjà pour ce contrat et cette période
            $existingBill = Bill::where('contract_id', $contract->id)
                ->where('periode_number', $monthsElapsed + 1) // On vérifie la période
                ->first();

            // Si aucune facture n'existe pour cette période, générer une nouvelle facture
            if (!$existingBill) {
                // Créer une nouvelle facture pour la période
                Bill::create([
                    'contract_id' => $contract->id,
                    'periode_number' => $monthsElapsed + 1, // Période basée sur le nombre de mois depuis le début
                    'paiment_amount' => $contract->monthly_price,
                    'payment_date' => null, // Pas encore payé, donc on laisse null
                ]);
            }
        }

        // Retourner un message ou rediriger après la génération des factures
        return redirect()->route('contracts.index')->with('success', 'Les factures ont été générées pour les contrats en cours.');
    }

    public function pay(Bill $bill)
    {
        if (!$bill->payment_date) {
            $bill->update(['payment_date' => now()]);
        }

        return redirect()->back()->with('success', 'Facture marquée comme payée.');
    }

}
