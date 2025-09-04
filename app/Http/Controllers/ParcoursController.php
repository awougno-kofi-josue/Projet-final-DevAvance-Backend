<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parcours;
class ParcoursController extends Controller
{
    // Liste tous les parcours pour le dashboard admin
    public function index()
    {
        $parcours = Parcours::all();
        return view('admin.parcours.index', compact('parcours'));
    }

    // Formulaire création parcours
    public function create()
    {
        return view('admin.parcours.create');
    }

    // Stocke un nouveau parcours
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $parcours = Parcours::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('admin.parcours.index')
                        ->with('success', 'Parcours créé avec succès');
    }

    // Formulaire édition parcours
    public function edit(Parcours $parcour)
    {
        return view('admin.parcours.edit', compact('parcour'));
    }

    // Mise à jour parcours
    public function update(Request $request, Parcours $parcour)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $parcour->update(['nom' => $request->nom]);

        return redirect()->route('admin.parcours.index')
                        ->with('success', 'Parcours mis à jour avec succès');
    }

    // Supprimer parcours
    public function destroy(Parcours $parcour)
    {
        $parcour->delete();
        return redirect()->route('admin.parcours.index')
                        ->with('success', 'Parcours supprimé avec succès');
    }

    ########################
    ####    API         ####
    ########################


    // --- Partie API --- //
    public function apiIndex()
    {
        return response()->json(Parcours::all());
    }

    public function apiStore(Request $request)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        $parcours = Parcours::create(['nom' => $request->nom]);

        return response()->json([
            'message' => 'Parcours créé avec succès',
            'data' => $parcours
        ], 201);
    }

    public function apiShow($id)
    {
        return response()->json(Parcours::findOrFail($id));
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        $parcours = Parcours::findOrFail($id);
        $parcours->update(['nom' => $request->nom]);

        return response()->json([
            'message' => 'Parcours mis à jour avec succès',
            'data' => $parcours
        ]);
    }

    public function apiDestroy($id)
    {
        $parcours = Parcours::findOrFail($id);
        $parcours->delete();

        return response()->json([
            'message' => 'Parcours supprimé avec succès'
        ]);
    }

}
