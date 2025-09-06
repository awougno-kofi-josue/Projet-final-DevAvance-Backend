<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcours;
use App\Models\Niveau;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $parcoursList = Parcours::all();
    $anneesList = Niveau::all();

    $query = Document::with(['parcours', 'niveau']);

    if ($request->filled('parcours_id')) {
        $query->where('parcours_id', $request->parcours_id);
    }

    if ($request->filled('annee_id')) {
        $query->where('niveau_id', $request->annee_id);
    }

    // Pagination : 9 documents par page
    $documents = $query->paginate(9)->withQueryString();

    return view('documents.index', compact('documents', 'parcoursList', 'anneesList'));
}


    public function create()
    {
        $parcours = Parcours::all();
        $annees = Niveau::with('parcours')->get();
        return view('documents.create', ['parcours' => $parcours,
                                         'annees' => $annees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function download(string $id)
    {
        $document = Document::findOrFail($id);
        return response()->download(storage_path("app/public/{$document->fichier}"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'fichier' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'niveau_id' => 'required|exists:niveaux,id',
            'parcours_id' => 'required|exists:parcours,id',
        ]);

        //enregistrement du fichier
        $path = $request->file('fichier')->store('documents', 'public');

        // Création du document
        $document = Document::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'fichier' => $path,
            'niveau_id' => $request->niveau_id,
            'parcours_id' => $request->parcours_id,
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Document créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function view($id)
{
    $document = Document::findOrFail($id);

    $filePath = storage_path("app/public/{$document->fichier}");

    // Vérifie si le fichier existe
    if (!file_exists($filePath)) {
        abort(404);
    }

    return response()->file($filePath);
}

##################
###   API      ###
##################


    // --- Partie API --- //

    // Liste paginée des documents avec filtres
    public function apiIndex(Request $request)
    {
        $query = Document::with(['parcours', 'niveau']);

        if ($request->filled('parcours_id')) {
            $query->where('parcours_id', $request->parcours_id);
        }

        if ($request->filled('niveau_id')) {
            $query->where('niveau_id', $request->niveau_id);
        }

        $documents = $query->paginate(9);

        return response()->json($documents);
    }

    // Créer un document
    public function apiStore(Request $request)
    {

        // Validation des données à désactiver pour l’instant
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'fichier' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'niveau_id' => 'required|exists:niveaux,id',
            'parcours_id' => 'required|exists:parcours,id',
        ]);

        $path = $request->file('fichier')->store('documents', 'public');

        $document = Document::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'fichier' => $path,
            'niveau_id' => $request->niveau_id,
            'parcours_id' => $request->parcours_id,
        ]);



        return response()->json([
            'message' => 'Document créé avec succès',
            'data' => $document
        ], 201);
    }

    // Afficher un document spécifique
    public function apiShow($id)
    {
        $document = Document::with(['parcours', 'niveau'])->findOrFail($id);

        return response()->json($document);
    }

    // Mettre à jour un document
    public function apiUpdate(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $request->validate([
            'titre' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'fichier' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'niveau_id' => 'sometimes|exists:niveaux,id',
            'parcours_id' => 'sometimes|exists:parcours,id',
        ]);

        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('documents', 'public');
            $document->fichier = $path;
        }

        $document->update($request->only(['titre', 'description', 'niveau_id', 'parcours_id']));

        return response()->json([
            'message' => 'Document mis à jour avec succès',
            'data' => $document
        ]);
    }

    // Supprimer un document
    public function apiDestroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();

        return response()->json([
            'message' => 'Document supprimé avec succès'
        ]);
    }

    // Télécharger le fichier
    public function apiDownload($id)
    {
        $document = Document::findOrFail($id);
        $filePath = storage_path("app/public/{$document->fichier}");

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Fichier introuvable'], 404);
        }

        return response()->download($filePath);
    }

    // Afficher le fichier dans le navigateur
    public function apiView($id)
{
    $document = Document::find($id);

    if (!$document) {
        return response()->json(['error' => 'Document non trouvé'], 404);
    }

    $filePath = storage_path("app/public/{$document->fichier}");

    if (!file_exists($filePath)) {
        return response()->json(['error' => 'Fichier introuvable'], 404);
    }

    return response()->file($filePath);
}




}
