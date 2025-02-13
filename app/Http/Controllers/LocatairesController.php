<?php

namespace App\Http\Controllers;

use App\Models\Locataires;
use Illuminate\Http\Request;

class LocatairesController extends Controller
{
    public function show(string $id): View
    {
        return view('Locataire_profile', [
            'locataire' => Locataires::findOrFail($id)
        ]);
    }
    public function list(): View {
        return view( 'Locataire_List');
    }
    public function store(): View {
        return view( 'Locataire_store');
    }
    public function create(): View {
        $id = 0;

        return $this->show($id);
    }
    public function edit(string $id): View {
        return view('Locataire_edit', [
            'locataire' => Locataires::findOrFail($id)
        ]);
    }
    public function update(string $id): View
    {
        return $this->show($id);
    }
    public function delete(string $id): View {
        return $this->list();
    }
}
