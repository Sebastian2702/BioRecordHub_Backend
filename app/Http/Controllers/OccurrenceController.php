<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Occurrence;
use App\Http\Requests\StoreOccurrenceRequest;
use Illuminate\Support\Facades\Log;

class OccurrenceController extends Controller
{
    public function index()
    {
        $projects = Occurrence::all();
        return response()->json($projects);
    }

    public function show($id)
    {
        $occurrence = Occurrence::with('project', 'nomenclature', 'fields', 'files')->find($id);

        if (!$occurrence) {
            return response()->json(['message' => 'Occurrence not found'], 404);
        }

        $baseStoragePath = storage_path('app/public');

        $images = [];
        $documents = [];

        foreach ($occurrence->files as $file) {
            $relativePath = str_replace($baseStoragePath, '', $file->path);
            $url = asset('storage' . $relativePath);

            $extension = strtolower(pathinfo($file->filename, PATHINFO_EXTENSION));

            if (in_array($extension, ['png', 'jpg', 'jpeg'])) {
                $images[] = [
                    'filename' => $file->filename,
                    'url' => $url,
                ];
            } else {
                $documents[] = [
                    'filename' => $file->filename,
                    'url' => $url,
                    'extension' => $extension,
                ];
            }
        }

        $occurrence->setRelation('images', collect($images));
        $occurrence->setRelation('files', collect($documents));

        return response()->json($occurrence);
    }


    public function store(StoreOccurrenceRequest $request)
    {
        if ($request->has('fields') && is_string($request->fields)) {
            $decodedFields = json_decode($request->fields, true);
            $request->merge(['fields' => $decodedFields]);
        }
        $validated = $request->validated();

        if ($request->hasFile('files')) {
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf', 'xlsx', 'docx'];
            foreach ($request->file('files') as $file) {
                $extension = strtolower($file->getClientOriginalExtension());
                if (!in_array($extension, $allowedExtensions)) {
                    return response()->json(['message' => 'Files must be of type: png, jpg, jpeg, pdf, docx, xlsx. type'], 422);
                }
            }
        }

        $occurrence_id = $validated['scientific_name'] . "_" . $validated['event_date'] . "_" . uniqid();

        $occurrence = Occurrence::create([
            'scientific_name'   => $validated['scientific_name'],
            'event_date'        => $validated['event_date'],
            'country'           => $validated['country'],
            'locality'          => $validated['locality'],
            'decimal_latitude'  => $validated['decimal_latitude'],
            'decimal_longitude' => $validated['decimal_longitude'],
            'basis_of_record'   => $validated['basis_of_record'],
            'nomenclature_id'   => $validated['nomenclature_id'],
            'project_id'        => $validated['project_id'],
            'contributors'      => $validated['contributors'],
            'occurrence_id'     => $occurrence_id,
        ]);

        if (!empty($request['fields'])) {
            foreach ($request['fields'] as $field) {
                $occurrence->fields()->attach($field['id'], ['value' => $field['value']]);
            }
        }

        $folderPath = storage_path("app/public/occurrences/{$occurrence->id}");
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $extension = $file->getClientOriginalExtension();

                $filename = 'project' . $occurrence->id . '_' . uniqid() . '.' . $extension;

                $file->move($folderPath, $filename);

                $occurrence->files()->create([
                    'filename' => $filename,
                    'path' => "{$folderPath}/{$filename}",
                ]);
            }
        }

        return response()->json($occurrence, 201);
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
