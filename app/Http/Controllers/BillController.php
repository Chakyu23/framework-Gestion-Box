<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $bills = Bill::whereHas('contract', function ($query) {
            $query->where('owner_id', Auth::id());
        })->get();

        return view('bills.index', compact('bills'));
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
}
