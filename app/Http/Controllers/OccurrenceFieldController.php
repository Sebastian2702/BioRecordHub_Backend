<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOccurrenceFieldRequest;
use App\Models\OccurrenceField;
/*use App\Models\Occurrence;*/

class OccurrenceFieldController extends Controller
{
    public function index()
    {
        $fields = OccurrenceField::all();
        return response()->json($fields);
    }

    public function show($id)
    {
        $field = OccurrenceField::find($id);
        if (!$field) {
            return response()->json(['message' => 'Occurrence field not found'], 404);
        }

        return response()->json($field);
    }

    public function store(StoreOccurrenceFieldRequest $request)
    {
        $field = OccurrenceField::create($request->validated());

        return response()->json([
            'message' => 'Occurrence field created successfully.',
            'data' => $field
        ], 201);
    }

    public function update(StoreOccurrenceFieldRequest $request, $id)
    {
        $field = OccurrenceField::find($id);
        if (!$field) {
            return response()->json(['message' => 'Occurrence field not found'], 404);
        }

        $field->update($request->validated());

        return response()->json([
            'message' => 'Occurrence field updated successfully.',
            'data' => $field
        ]);
    }

    /*public function destroy($id)
    {
        $field = OccurrenceField::find($id);
        if (!$field) {
            return response()->json(['message' => 'Occurrence field not found'], 404);
        }

        // Check if any occurrences are using this field
        $occurrenceCount = $field->occurrences()->count(); // assuming relationship exists

        if ($occurrenceCount > 0) {
            return response()->json([
                'message' => 'This field is used in existing occurrences and cannot be deleted.'
            ], 400);
        }

        $field->delete();

        return response()->json(['message' => 'Occurrence field deleted successfully.']);
    }*/
}
