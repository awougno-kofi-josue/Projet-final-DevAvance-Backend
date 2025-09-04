<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parcours;

class ParcoursAdminController extends Controller
{
    public function index()
    {
        $parcours = Parcours::all();
        return view('admin.parcours.index', compact('parcours'));
    }

    public function create()
    {
        return view('admin.parcours.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        Parcours::create(['nom' => $request->nom]);

        return redirect()->route('admin.parcours.index')
                         ->with('success', 'Parcours créé avec succès');
    }

    public function edit(Parcours $parcour)
    {
        return view('admin.parcours.edit', compact('parcour'));
    }

    public function update(Request $request, Parcours $parcour)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        $parcour->update(['nom' => $request->nom]);

        return redirect()->route('admin.parcours.index')
                         ->with('success', 'Parcours mis à jour avec succès');
    }

    public function destroy(Parcours $parcour)
    {
        $parcour->delete();
        return redirect()->route('admin.parcours.index')
                         ->with('success', 'Parcours supprimé avec succès');
    }

    // Méthodes API
    public function apiIndex()
    {
        return response()->json(Parcours::all(), 200);
    }
    public function apiShow(Parcours $parcours)
    {
        return response()->json($parcours);
    }
    public function apiUpdate(Request $request, Parcours $parcours)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        $parcours->update(['nom' => $request->nom]);
        return response()->json($parcours, 200);
    }
    public function apiDestroy(Parcours $parcours)
    {
        $parcours->delete();
        return response()->json(null, 204);
    }
    public function apiStore(Request $request)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        $parcours = Parcours::create(['nom' => $request->nom]);
        return response()->json($parcours, 201);
    }

}
