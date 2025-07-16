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

        if (!Bibliography::where('key', $validated['key'])->exists()) {
            $biblio = Bibliography::create($validated);
        }
        else {
            return response()->json(['message' => 'Bibliography with this key already exists'], 422);
        }
        return response()->json($biblio, 201);
    }



    public function storeMultiple(Request $request)
    {
        $data = $request->validate([
            'bibliographies' => 'required|array',
            'bibliographies.*' => 'array',
        ]);


        $incoming = collect($data['bibliographies']);

        // Get all existing keys from DB
        $existingKeys = Bibliography::whereIn('key', $incoming->pluck('key'))->pluck('key')->all();

        // Filter original array to remove entries whose key exists in DB
        $newEntries = array_filter($data['bibliographies'], function ($item) use ($existingKeys) {
            return !in_array($item['key'], $existingKeys);
        });

        // Reindex array (optional, if you want 0-based keys)
        $newEntries = array_values($newEntries);

        // Now you can insert $newEntries
        Bibliography::insert($newEntries);

        return response()->json([
            'inserted_count' => count($newEntries),
            'skipped_duplicates' => count($data['bibliographies']) - count($newEntries),
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

        if ($biblio->nomenclatures()->exists()) {
            return response()->json([
                'message' => 'Cannot delete: This bibliography is still referenced by one or more nomenclatures.'
            ], 400);
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
