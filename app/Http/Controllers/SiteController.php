<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Site;

class SiteController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $site = Site::where('user_id', Auth::id())->get();
        return view('site.index', compact('site'));
    }

    public function create()
    {
        return view('site.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:150',
            'postalCode' => 'required|string|max:5',
            'telephone' => 'required|string|max:15',
            'mail' => 'required|email|max:320',
            'active' => 'boolean',
        ]);

        Site::create(array_merge($request->all(), ['user_id' => Auth::id()]));

        return redirect()->route('site.index')->with('success', 'Site ajouté avec succès');
    }

    public function show(Site $site)
    {
        $this->authorize('view', $site);
        return view('site.show', compact('site'));
    }

    public function edit(Site $site)
    {
        $this->authorize('update', $site);
        return view('site.edit', compact('site'));
    }

    public function update(Request $request, Site $site)
    {
        $this->authorize('update', $site);

        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:150',
            'postalCode' => 'required|string|max:5',
            'telephone' => 'required|string|max:15',
            'mail' => 'required|email|max:320' . $site->id,
            'active' => 'boolean',
        ]);

        $site->update($request->all());

        return redirect()->route('site.index')->with('success', 'Site mis à jour');
    }

    public function destroy(Site $site)
    {
        $this->authorize('delete', $site);
        $site->delete();

        return redirect()->route('site.index')->with('success', 'Site supprimé');
    }
}
