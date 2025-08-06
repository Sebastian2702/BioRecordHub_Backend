<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nomenclature;
use App\Models\Bibliography;
use App\Http\Requests\StoreNomenclatureRequest;

class NomenclatureController extends Controller
{
    public function index()
    {
        $nomenclatures = Nomenclature::all();
        return response()->json($nomenclatures);
    }


    public function store(StoreNomenclatureRequest $request)
    {
        $validated = $request->validated();

        $bibliographyIds = $validated['bibliographies'] ?? [];
        unset($validated['bibliographies']);

        $imageFiles = $validated['images'] ?? null;
        unset($validated['images']);

        $nomenclature = Nomenclature::create($validated);

        if (!empty($bibliographyIds)) {
            $nomenclature->bibliographies()->sync($bibliographyIds);
        }

        $folderPath = storage_path("app/public/nomenclature_images/{$nomenclature->id}");
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = 'nomenclature' . $nomenclature->id . '_' . uniqid() . '.jpg';
                $path = "{$folderPath}/{$filename}";

                $image->move($folderPath, $filename);

                $nomenclature->images()->create([
                    'filename' => $filename,
                    'path' => $path,
                ]);
            }
        }

        return response()->json($nomenclature->load('bibliographies', 'images'), 201);
    }



    public function storeMultiple(Request $request)
    {
        $validated = $request->validate([
            'nomenclatures' => 'required|array',
        ]);

        $createdNomenclatures = [];

        foreach ($validated['nomenclatures'] as $entry) {
            // Extract and remove bibliography IDs
            $bibliographyIds = $entry['bibliography_ids'] ?? [];
            unset($entry['bibliography_ids']);

            // Create nomenclature
            $nomenclature = Nomenclature::create($entry);

            // Attach bibliographies
            if (!empty($bibliographyIds)) {
                $nomenclature->bibliographies()->sync($bibliographyIds);
            }

            // Append loaded nomenclature (with bibliographies) to result
            $createdNomenclatures[] = $nomenclature->load('bibliographies');
        }

        return response()->json([
            'inserted_count' => count($createdNomenclatures),
            'data' => $createdNomenclatures,
        ], 201);
    }

    public function getAutocomplete()
    {
        $columns = [
            'kingdom',
            'phylum',
            'subphylum',
            'class',
            'order',
            'suborder',
            'infraorder',
            'superfamily',
            'family',
            'subfamily',
            'tribe',
            'genus',
            'subgenus',
            'species',
            'subspecies',
            'author',
        ];

        $result = [];

        foreach ($columns as $column) {
            $result[$column] = Nomenclature::query()
                ->whereNotNull($column)
                ->distinct()
                ->orderBy($column)
                ->pluck($column)
                ->toArray();
        }

        return response()->json($result);
    }

    public function getSpeciesAutocomplete()
    {
        $species = Nomenclature::query()
            ->whereNotNull('species')
            ->whereNotNull('author')
            ->select('id', 'species', 'author')
            ->distinct()
            ->orderBy('species')
            ->get();

        return response()->json($species);
    }

    public function searchNomenclatures(Request $request)
    {
        $fields = [
            'kingdom', 'phylum', 'subphylum', 'class', 'order', 'suborder', 'infraorder',
            'superfamily', 'family', 'subfamily', 'tribe', 'genus', 'subgenus',
            'species', 'subspecies', 'author',
        ];

        $filters = collect($request->only($fields))
            ->filter(fn($value) => !is_null($value) && $value !== '');

        if ($filters->isEmpty()) {
            abort(400, 'No filters provided');
        }

        $query = Nomenclature::query();

        foreach ($filters as $column => $value) {
            $query->where($column, $value);
        }

        $results = $query->get();

        return response()->json($results);

    }

    public function show($id)
    {
        $nomenclature = Nomenclature::with('bibliographies', 'images', 'occurrences')->find($id);

        if (!$nomenclature) {
            return response()->json(['message' => 'Nomenclature not found'], 404);
        }

        $nomenclature->images->transform(function ($image) {
            $relativePath = str_replace(storage_path('app/public'), '', $image->path);
            $image->url = asset('storage' . $relativePath);
            return $image;
        });

        return response()->json($nomenclature);
    }

    public function update($id, StoreNomenclatureRequest $request)
    {
        $validated = $request->validated();
        $nomenclature = Nomenclature::find($id);

        $newBibliographyIds = $validated['bibliographies'] ?? [];
        unset($validated['bibliographies']);

        $nomenclature->update($validated);

        $nomenclature->bibliographies()->sync($newBibliographyIds);

        $imageFiles = $validated['newImages'] ?? null;
        unset($validated['newImages']);

        $folderPath = storage_path("app/public/nomenclature_images/{$nomenclature->id}");
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        if ($request->hasFile('newImages')) {
            foreach ($request->file('newImages') as $image) {
                $filename = 'nomenclature' . $nomenclature->id . '_' . uniqid() . '.jpg';
                $path = "{$folderPath}/{$filename}";

                $image->move($folderPath, $filename);

                $nomenclature->images()->create([
                    'filename' => $filename,
                    'path' => $path,
                ]);
            }
        }

        return response()->json([
            'message' => 'Nomenclature updated successfully.',
            'nomenclature' => $nomenclature->load('bibliographies')
        ]);

    }
    public function destroy($id)
    {
        $nomenclature = Nomenclature::find($id);

        if (!$nomenclature) {
            return response()->json(['message' => 'Nomenclature not found'], 404);
        }

        $nomenclature->bibliographies()->detach();

        $nomenclature->images()->delete();


        $folderPath = storage_path("app/public/nomenclature_images/{$nomenclature->id}");
        if (file_exists($folderPath)) {
            \File::deleteDirectory($folderPath);
        }

        $nomenclature->delete();

        return response()->json(['message' => 'Nomenclature and related references deleted successfully']);
    }


    public function destroyBibliographyReference($nomenclatureId, $bibliographyId)
    {
        $bibliography = Bibliography::find($bibliographyId);
        if (!$bibliography) {
            return response()->json(['message' => 'Bibliography not found'], 404);
        }

        $nomenclature = Nomenclature::find($nomenclatureId);
        if (!$nomenclature) {
            return response()->json(['message' => 'Nomenclature not found'], 404);
        }

        $bibliography->nomenclatures()->detach($nomenclatureId);

        return response()->json(['message' => 'Nomenclature reference removed successfully']);
    }

    public function destroyAllFiles($id)
    {
        $nomenclature = Nomenclature::find($id);

        if (!$nomenclature) {
            return response()->json(['message' => 'Nomenclature not found'], 404);
        }

        foreach ($nomenclature->images as $image) {
            $filePath = storage_path('app/public/nomenclature_images/' . $nomenclature->id . '/' . $image->filename);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
            $image->delete();
        }

        return response()->json(['message' => 'Nomenclature images deleted successfully']);
    }

    public function destroyFile($nomenclatureId, $imageId)
    {
        $nomenclature = Nomenclature::find($nomenclatureId);
        if (!$nomenclature) {
            return response()->json(['message' => 'Nomenclature not found'], 404);
        }

        $image = $nomenclature->images()->find($imageId);
        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        $filePath = storage_path('app/public/nomenclature_images/' . $nomenclature->id . '/' . $image->filename);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
