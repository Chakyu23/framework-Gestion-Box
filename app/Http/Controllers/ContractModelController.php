<?php

namespace App\Http\Controllers;

use App\Models\ContractModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContractModelController extends Controller
{
    use AuthorizesRequests;

    /**
     * Afficher la liste des modèles de contrat
     */
    public function index()
    {
        $contractModels = ContractModel::where('owner_id', Auth::id())->get();
        return view('contractModels.index', compact('contractModels'));
    }

    /**
     * Afficher le formulaire de création d'un modèle de contrat
     */
    public function create()
    {
        return view('contractModels.create');
    }

    /**
     * Stocker un nouveau modèle de contrat
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'owner_id' => 'required|exists:users,id',
        ]);

        ContractModel::create(array_merge($request->all(), ['owner_id' => Auth::id()]));

        return redirect()->route('contractModels.index')->with('success', 'Modèle de contrat ajouté avec succès');
    }

    /**
     * Afficher les détails d'un modèle de contrat
     */
    public function show(ContractModel $contractModel)
    {
        $this->authorize('view', $contractModel);

        return view('contractModels.show', compact('contractModel'));
    }

    /**
     * Afficher le formulaire d'édition d'un modèle de contrat
     */
    public function edit(ContractModel $contractModel)
    {
        $this->authorize('update', $contractModel);

        return view('contractModels.edit', compact('contractModel'));
    }

    /**
     * Mettre à jour un modèle de contrat
     */
    public function update(Request $request, ContractModel $contractModel)
    {
        $this->authorize('update', $contractModel);

        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $contractModel->update($request->all());

        return redirect()->route('contractModels.index')->with('success', 'Modèle de contrat mis à jour');
    }

    /**
     * Supprimer un modèle de contrat
     */
    public function destroy(ContractModel $contractModel)
    {
        $this->authorize('delete', $contractModel);

        $contractModel->delete();

        return redirect()->route('contractModels.index')->with('success', 'Modèle de contrat supprimé');
    }
}
