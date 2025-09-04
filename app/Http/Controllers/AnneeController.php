<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Niveau;


class AnneeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Niveau::with('parcours')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'parcours' => 'required|exists:parcours,id',
        ]);

        $niveau = Niveau::create([
            'nom' => $request->nom,
            'parcours_id' => $request->parcours_id,
        ]);

        return response()->json([
            'message' => 'Année créée avec succès',
            'data' => $niveau
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Niveau::with('parcours')->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'parcours_id' => 'required|exists:parcours,id',
        ]);

        $niveau = Niveau::findOrFail($id);
        $niveau->update([
            'nom' => $request->nom,
            'parcours_id' => $request->parcours_id,
        ]);

        return response()->json([
            'message' => 'Niveau mis à jour avec succès',
            'data' => $niveau
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $niveau = Niveau::findOrFail($id);
        $niveau->delete();

        return response()->json([
            'message' => 'Niveau supprimé avec succès'
        ]);
    }

    ##################
    ###   API      ###
    ##################


    // Liste paginée des années avec filtres
    public function apiIndex(Request $request)
    {
        $query = niveau::with('parcours');

        if ($request->filled('parcours_id')) {
            $query->where('parcours_id', $request->parcours_id);
        }

        $niveaus = $query->paginate(9);

        return response()->json($niveaus);
    }



    // Créer une année
    public function apiStore(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'parcours_id' => 'required|exists:parcours,id',
        ]);

        $niveau = niveau::create([
            'nom' => $request->nom,
            'parcours_id' => $request->parcours_id,
        ]);

        return response()->json([
            'message' => 'Année créée avec succès',
            'data' => $niveau
        ], 201);
    }

    // Afficher une année spécifique
    public function apiShow($id)
    {
        $niveau = Niveau::with('parcours')->findOrFail($id);

        return response()->json($niveau);
    }

    // Mettre à jour une année
    public function apiUpdate(Request $request, $id)
    {
        $niveau = Niveau::findOrFail($id);

        $request->validate([
            'nom' => 'sometimes|string|max:255',
            'parcours_id' => 'sometimes|exists:parcours,id',
        ]);

        $niveau->update($request->only(['nom', 'parcours_id']));

        return response()->json([
            'message' => 'Année mise à jour avec succès',
            'data' => $niveau
        ]);
    }

    // Supprimer une année
    public function apiDestroy($id)
    {
        $niveau = Niveau::findOrFail($id);
        $niveau->delete();

        return response()->json([
            'message' => 'Année supprimée avec succès'
        ]);
    }

}
