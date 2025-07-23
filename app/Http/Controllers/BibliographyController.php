<?php

namespace App\Http\Controllers;

use App\Models\Bibliography;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBibliographyRequest;
use Illuminate\Support\Facades\Validator;

class BibliographyController extends Controller
{
    private function generateUniqueKey(): string
    {
        do {
            $key = 'bib_' . uniqid();
        } while (Bibliography::where('key', $key)->exists());

        return $key;
    }
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

        if (empty($validated['key'])) {
            $validated['key'] = $this->generateUniqueKey();
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid('biblio_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/bibliographies', $filename);
            $validated['file'] = $filename;
        }


        $biblio = Bibliography::create($validated);

        return response()->json($biblio, 201);
    }



    public function storeMultiple(Request $request)
    {$data = $request->validate([
        'bibliographies' => 'required|array',
        'bibliographies.*' => 'array',
    ]);

        $validatedEntries = [];

        foreach ($data['bibliographies'] as $index => $item) {
            if (!array_key_exists('key', $item) || empty($item['key'])) {

                $item['key'] = $this->generateUniqueKey();
            }

            $validator = Validator::make($item, (new StoreBibliographyRequest)->rules());

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'error' => "Validation failed on item $index",
                ], 422);
            }

            $validatedEntries[] = $validator->validated();
        }

        $existingKeys = Bibliography::whereIn('key', array_column($validatedEntries, 'key'))->pluck('key')->all();

        $newEntries = array_filter($validatedEntries, function ($item) use ($existingKeys) {
            return !in_array($item['key'], $existingKeys);
        });

        Bibliography::insert($newEntries);

        return response()->json([
            'inserted_count' => count($newEntries),
            'skipped_duplicates' => count($validatedEntries) - count($newEntries),
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
    public function update(StoreBibliographyRequest $request, string $id)
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
