<?php

namespace App\Http\Controllers;

use App\Models\Bibliography;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBibliographyRequest;

class BibliographyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Bibliography::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBibliographyRequest  $request)
    {
        $validated = $request->validated();

        $biblio = Bibliography::create($validated);

        return response()->json($biblio, 201);
    }

    public function storeMultiple(Request $request)
    {
        $data = $request->validate([
            'bibliographies' => 'required|array',
            'bibliographies.*' => 'array',
        ]);

        $inserted = Bibliography::insert($data['bibliographies']);

        return response()->json([
            'success' => $inserted,
            'count' => count($data['bibliographies']),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $biblio = Bibliography::with('nomenclatures')->find($id);


        if (!$biblio) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($biblio, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $biblio = Bibliography::find($id);

        if (!$biblio) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $biblio->update($request->all());

        return response()->json($biblio, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $biblio = Bibliography::find($id);

        if (!$biblio) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $biblio->delete();

        return response()->json(['message' => 'Deleted successfully'], 200);
    }

    public function destroyNomenclatureReference(string $bibliographyId, string $nomenclatureId)
    {
        $biblio = Bibliography::find($bibliographyId);

        if (!$biblio) {
            return response()->json(['message' => 'Bibliography not found'], 404);
        }

        // Check if the relation exists before trying to detach
        if (!$biblio->nomenclatures()->where('nomenclature_id', $nomenclatureId)->exists()) {
            return response()->json(['message' => 'Nomenclature not associated with this bibliography'], 404);
        }

        $biblio->nomenclatures()->detach($nomenclatureId);

        return response()->json(['message' => 'Nomenclature reference removed successfully'], 200);
    }
}
