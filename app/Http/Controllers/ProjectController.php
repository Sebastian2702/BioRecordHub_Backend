<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $fileIds = $data['files'] ?? [];
        unset($data['files']);

        $project = Project::create($data);

        $folderPath = storage_path("app/public/projects_files/{$project->id}");
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = 'project' . $project->id . '_' . uniqid() . '.pdf';
                $path = "{$folderPath}/{$filename}";

                $file->move($folderPath, $filename);

                $project->files()->create([
                    'filename' => $filename,
                    'path' => $path,
                ]);
            }
        }

        return response()->json($project->load('files'), 201);
    }

    public function show($id)
    {
        $project = Project::with('files', 'occurrences')->find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $project->files->transform(function ($file) {
            $relativePath = str_replace(storage_path('app/public'), '', $file->path);
            $file->url = asset('storage' . $relativePath);
            return $file;
        });

        return response()->json($project);
    }

    public function getProjectsAutoComplete(Request $request)
    {
        $projects = Project::query()
            ->whereNotNull('title')
            ->whereNotNull('research_type')
            ->whereNotNull('description')
            ->select('id', 'title', 'research_type', 'description')
            ->distinct()
            ->orderBy('id')
            ->get();

        return response()->json($projects);
    }

    public function update(StoreProjectRequest $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $data = $request->validated();

        $fileIds = $data['newFiles'] ?? [];
        unset($data['newFiles']);

        $project->update($data);

        $folderPath = storage_path("app/public/projects_files/{$project->id}");
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        if ($request->hasFile('newFiles')) {
            foreach ($request->file('newFiles') as $file) {
                $filename = 'project' . $project->id . '_' . uniqid() . '.pdf';
                $path = "{$folderPath}/{$filename}";

                $file->move($folderPath, $filename);

                $project->files()->create([
                    'filename' => $filename,
                    'path' => $path,
                ]);
            }
        }

        return response()->json($project->load('files'));
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $project->files()->delete();
        $folderPath = storage_path("app/public/projects_files/{$project->id}");
        if (file_exists($folderPath)) {
            \File::deleteDirectory($folderPath);
        }
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }

    public function destroyFile($projectId, $fileId)
    {
        $project = Project::find($projectId);
        if (!$project) {
            return response()->json(['message' => 'Nomenclature not found'], 404);
        }

        $file = $project->files()->find($fileId);
        if (!$file) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        $filePath = storage_path('app/public/projects_files/' . $project->id . '/' . $file->filename);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $file->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }


}
