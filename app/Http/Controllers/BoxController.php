<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BoxController extends Controller
{
    use AuthorizesRequests;

    /**
     * Afficher la liste des boxes
     */
    public function index()
    {
        $boxes = Box::where('owner_id', Auth::id())->get();
        return view('boxes.index', compact('boxes'));
    }

    /**
     * Afficher le formulaire de création d'une box
     */
    public function create()
    {
        return view('boxes.create');
    }

    /**
     * Stocker une nouvelle box
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'prices' => 'required|numeric',
            'owner_id' => 'required|exists:users,id',
        ]);

        Box::create(array_merge($request->all(), ['owner_id' => Auth::id()]));

        return redirect()->route('boxes.index')->with('success', 'Box ajoutée avec succès');
    }

    /**
     * Afficher les détails d'une box
     */
    public function show(Box $box)
    {
        $this->authorize('view', $box);

        return view('boxes.show', compact('box'));
    }

    /**
     * Afficher le formulaire d'édition d'une box
     */
    public function edit(Box $box)
    {
        $this->authorize('update', $box);

        return view('boxes.edit', compact('box'));
    }

    /**
     * Mettre à jour une box
     */
    public function update(Request $request, Box $box)
    {
        $this->authorize('update', $box);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'prices' => 'required|numeric',
        ]);

        $box->update($request->all());

        return redirect()->route('boxes.index')->with('success', 'Box mise à jour');
    }

    /**
     * Supprimer une box
     */
    public function destroy(Box $box)
    {
        $this->authorize('delete', $box);

        $box->delete();

        return redirect()->route('boxes.index')->with('success', 'Box supprimée');
    }
}
