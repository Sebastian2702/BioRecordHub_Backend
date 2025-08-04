<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Occurrence;

class OccurrenceController extends Controller
{
    public function index()
    {
        $projects = Occurrence::all();
        return response()->json($projects);
    }

    public function show($id)
    {
        $occurrence = Occurrence::with('project', 'nomenclature', 'fields')->find($id);
        if (!$occurrence) {
            return response()->json(['message' => 'Occurrence not found'], 404);
        }
        return response()->json($occurrence);
    }

    public function destroy($id)
    {
        $occurrence = Occurrence::find($id);

        if (!$occurrence) {
            return response()->json(['message' => 'Occurrence not found'], 404);
        }

        $occurrence->fields()->detach();


        $occurrence->delete();

        return response()->json(['message' => 'Occurrence deleted successfully']);
    }
}
