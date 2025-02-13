<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BoxModel;

class BoxModelController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    // Afficher la liste des modèles de box
    public function index()
    {
        $boxModels = BoxModel::where('user_id', Auth::id())->get();
        return view('model.box.index', compact('boxModels'));
    }

    // Afficher le formulaire pour créer un modèle de box
    public function create()
    {
        return view('model.box.create');
    }

    // Sauvegarder un modèle de box
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'surface' => 'required|numeric',
            'height' => 'required|numeric',
            'security' => 'required|boolean',
            'refrigerate' => 'required|boolean',
            'active' => 'boolean',
        ]);

        BoxModel::create(array_merge($request->all(), ['user_id' => Auth::id()]));

        return redirect()->route('model.box.index')->with('success', 'Modèle de box ajouté avec succès');
    }

    // Afficher un modèle de box spécifique
    public function show(BoxModel $boxModel)
    {
        $this->authorize('view', $boxModel);
        return view('model.box.show', compact('boxModel'));
    }

    // Afficher le formulaire pour éditer un modèle de box
    public function edit(BoxModel $boxModel)
    {
        $this->authorize('update', $boxModel);
        return view('model.box.edit', compact('boxModel'));
    }

    // Mettre à jour un modèle de box
    public function update(Request $request, BoxModel $boxModel)
    {
        $this->authorize('update', $boxModel);

        $request->validate([
            'name' => 'required|string|max:255',
            'surface' => 'required|numeric',
            'height' => 'required|numeric',
            'security' => 'required|boolean',
            'refrigerate' => 'required|boolean',
            'active' => 'boolean',
        ]);

        $boxModel->update($request->all());

        return redirect()->route('model.box.index')->with('success', 'Modèle de box mis à jour');
    }

    // Supprimer un modèle de box
    public function destroy(BoxModel $boxModel)
    {
        $this->authorize('delete', $boxModel);
        $boxModel->delete();

        return redirect()->route('model.box.index')->with('success', 'Modèle de box supprimé');
    }
}
