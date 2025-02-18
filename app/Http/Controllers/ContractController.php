<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Box;
use App\Models\ContractModel;
use App\Rules\NoOverlappingContracts;
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
        // Récupérer tous les contrats avec les relations nécessaires
        $contracts = Contract::with(['tenant', 'contractModel', 'box', 'bills'])
            ->where('owner_id', Auth::id())->get();

        return view('contracts.index', compact('contracts'));
    }

    /**
     * Afficher le formulaire de création d'un contrat
     */
    public function create()
    {
        $today = now()->toDateString();
        $userId = auth()->id(); // Récupère l'ID de l'utilisateur connecté

        // Récupérer les boxes du propriétaire qui ne sont pas occupés
        $boxes = Box::where('owner_id', $userId)
            ->whereDoesntHave('contracts', function ($query) use ($today) {
                $query->where('date_start', '<=', $today)
                    ->where('date_end', '>=', $today);
            })
            ->get();

        // Récupérer les locataires appartenant à l'utilisateur
        $tenants = Tenant::where('data_owner_id', $userId)->get();

        // Récupérer les modèles de contrat du propriétaire
        $contractModels = ContractModel::where('owner_id', $userId)->get();

        return view('contracts.create', compact('tenants', 'boxes', 'contractModels'));
    }

    /**
     * Stocker un nouveau contrat
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date', 'after:date_start'],
            'monthly_price' => ['required', 'numeric', 'min:0'],
            'owner_id' => ['required', 'exists:users,id'],
            'tenant_id' => ['required', 'exists:tenants,id'],
            'box_id' => ['required', 'exists:boxes,id', new NoOverlappingContracts($request->box_id, $request->date_start, $request->date_end)],
            'contract_model_id' => ['required', 'exists:contract_models,id'],
        ]);

        // Création du contrat
        $contract = Contract::create($validated);

        // Redirection vers la vue `show` avec l'ID du contrat
        return redirect()->route('contracts.show', $contract->id)
            ->with('success', 'Contrat ajouté avec succès.');
    }




    /**
     * Afficher les détails d'un contrat
     */
    public function show(Contract $contract)
    {
        // Récupérer le modèle de contrat associé
        $contractModel = $contract->contractModel;

        if (!$contractModel) {
            return back()->withErrors(['contract_model' => 'Aucun modèle de contrat associé.']);
        }

        // Récupérer le contenu du modèle de contrat
        $content = $contractModel->content;

        // Liste des variables et de leurs valeurs
        $variables = [
            '%contract_id%' => $contract->id,
            '%contract_start%' => $contract->date_start,
            '%contract_end%' => $contract->date_end,
            '%monthly_price%' => number_format($contract->monthly_price, 2, ',', ' ') . ' €',
            '%owner_name%' => $contract->owner->name,
            '%tenant_name%' => $contract->tenant->name,
            '%tenant_email%' => $contract->tenant->email,
            '%tenant_phone%' => $contract->tenant->phone,
            '%box_name%' => $contract->box->name,
            '%box_address%' => $contract->box->address,
        ];

        // Remplacement des variables dans le contenu du modèle de contrat
        $contractContent = str_replace(array_keys($variables), array_values($variables), $content);

        return view('contracts.show', compact('contract', 'contractContent'));
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
