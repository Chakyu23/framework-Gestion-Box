<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Locataire;

class LocataireController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $locataires = Locataire::where('user_id', Auth::id())->get();
        return view('locataires.index', compact('locataires'));
    }

    public function create()
    {
        return view('locataires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'telephone' => 'required|string|max:15',
            'mail' => 'required|email|max:320',
            'IBAN' => 'nullable|string|max:32',
            'adresse' => 'required|string|max:150',
            'postalCode' => 'required|string|max:5',
            'city' => 'required|string|max:50',
            'active' => 'boolean',
        ]);

        Locataire::create(array_merge($request->all(), ['user_id' => Auth::id()]));

        return redirect()->route('locataires.index')->with('success', 'Locataire ajouté avec succès');
    }

    public function show(Locataire $locataire)
    {
        $this->authorize('view', $locataire);
        return view('locataires.show', compact('locataire'));
    }

    public function edit(Locataire $locataire)
    {
        $this->authorize('update', $locataire);
        return view('locataires.edit', compact('locataire'));
    }

    public function update(Request $request, Locataire $locataire)
    {
        $this->authorize('update', $locataire);

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'mail' => 'required|email|unique:locataires,mail,' . $locataire->id,
            'IBAN' => 'nullable|string',
            'adresse' => 'required|string',
            'postalCode' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'active' => 'boolean',
        ]);

        $locataire->update($request->all());

        return redirect()->route('locataires.index')->with('success', 'Locataire mis à jour');
    }

    public function destroy(Locataire $locataire)
    {
        $this->authorize('delete', $locataire);
        $locataire->delete();

        return redirect()->route('locataires.index')->with('success', 'Locataire supprimé');
    }
}
