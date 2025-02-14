<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TenantController extends Controller
{
    use AuthorizesRequests;

    /**
     * Afficher la liste des locataires
     */
    public function index()
    {
        $tenants = Tenant::where('data_owner_id', Auth::id())->get();
        return view('tenants.index', compact('tenants'));
    }

    /**
     * Afficher le formulaire de création d'un locataire
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Stocker un nouveau locataire
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tenants,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'data_owner_id' => 'required|exists:users,id',
        ]);

        Tenant::create(array_merge($request->all(), ['data_owner_id' => Auth::id()]));

        return redirect()->route('tenants.index')->with('success', 'Locataire ajouté avec succès');
    }

    /**
     * Afficher les détails d'un locataire
     */
    public function show(Tenant $tenant)
    {
        $this->authorize('view', $tenant);

        return view('tenants.show', compact('tenant'));
    }

    /**
     * Afficher le formulaire d'édition d'un locataire
     */
    public function edit(Tenant $tenant)
    {
        $this->authorize('update', $tenant);

        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Mettre à jour un locataire
     */
    public function update(Request $request, Tenant $tenant)
    {
        $this->authorize('update', $tenant);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tenants,email,' . $tenant->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $tenant->update($request->all());

        return redirect()->route('tenants.index')->with('success', 'Locataire mis à jour');
    }

    /**
     * Supprimer un locataire
     */
    public function destroy(Tenant $tenant)
    {
        $this->authorize('delete', $tenant);

        $tenant->delete();

        return redirect()->route('tenants.index')->with('success', 'Locataire supprimé');
    }
}
