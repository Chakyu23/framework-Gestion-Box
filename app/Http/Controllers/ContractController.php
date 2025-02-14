<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Box;
use App\Models\ContractModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContractController extends Controller
{
    use AuthorizesRequests;

    /**
     * Afficher la liste des contrats
     */
    public function index()
    {
        $contracts = Contract::where('owner_id', Auth::id())->get();
        return view('contracts.index', compact('contracts'));
    }

    /**
     * Afficher le formulaire de création d'un contrat
     */
    public function create()
    {
        $tenants = Tenant::where('data_owner_id', Auth::id())->get();
        $boxes = Box::where('owner_id', Auth::id())->get();
        $contractModels = ContractModel::where('owner_id', Auth::id())->get();

        return view('contracts.create', compact('tenants', 'boxes', 'contractModels'));
    }

    /**
     * Stocker un nouveau contrat
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_start' => 'required|date',
            'date_end' => 'required|date|after:date_start',
            'monthly_price' => 'required|numeric',
            'tenant_id' => 'required|exists:tenants,id',
            'box_id' => 'required|exists:boxes,id',
            'contract_model_id' => 'required|exists:contract_models,id',
            'owner_id' => 'required|exists:users,id',
        ]);

        Contract::create(array_merge($request->all(), ['owner_id' => Auth::id()]));

        return redirect()->route('contracts.index')->with('success', 'Contrat ajouté avec succès');
    }

    /**
     * Afficher les détails d'un contrat
     */
    public function show(Contract $contract)
    {
        $this->authorize('view', $contract);

        return view('contracts.show', compact('contract'));
    }

    /**
     * Afficher le formulaire d'édition d'un contrat
     */
    public function edit(Contract $contract)
    {
        $this->authorize('update', $contract);

        $tenants = Tenant::where('data_owner_id', Auth::id())->get();
        $boxes = Box::where('owner_id', Auth::id())->get();
        $contractModels = ContractModel::where('owner_id', Auth::id())->get();

        return view('contracts.edit', compact('contract', 'tenants', 'boxes', 'contractModels'));
    }

    /**
     * Mettre à jour un contrat
     */
    public function update(Request $request, Contract $contract)
    {
        $this->authorize('update', $contract);

        $request->validate([
            'date_start' => 'required|date',
            'date_end' => 'required|date|after:date_start',
            'monthly_price' => 'required|numeric',
            'tenant_id' => 'required|exists:tenants,id',
            'box_id' => 'required|exists:boxes,id',
            'contract_model_id' => 'required|exists:contract_models,id',
        ]);

        $contract->update($request->all());

        return redirect()->route('contracts.index')->with('success', 'Contrat mis à jour');
    }

    /**
     * Supprimer un contrat
     */
    public function destroy(Contract $contract)
    {
        $this->authorize('delete', $contract);

        $contract->delete();

        return redirect()->route('contracts.index')->with('success', 'Contrat supprimé');
    }
}
