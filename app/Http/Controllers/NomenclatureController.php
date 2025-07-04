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

        // Extract bibliography IDs (if any), and remove from data before create
        $bibliographyIds = $validated['bibliographies'] ?? [];
        unset($validated['bibliographies']);

        // Create the nomenclature
        $nomenclature = Nomenclature::create($validated);

        // Attach bibliographies
        if (!empty($bibliographyIds)) {
            $nomenclature->bibliographies()->sync($bibliographyIds);
        }

        return response()->json($nomenclature->load('bibliographies'), 201);
    }

    public function show($id)
    {
        $nomenclature = Nomenclature::with('bibliographies')->find($id);

        if (!$nomenclature) {
            return response()->json(['message' => 'Nomenclature not found'], 404);
        }

        return response()->json($nomenclature);
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
}
