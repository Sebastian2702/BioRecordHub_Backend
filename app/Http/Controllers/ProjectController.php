<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Http\Requests\StoreProjectRequest;

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

        if (!empty($fileIds)) {
            $project->files()->sync($fileIds);
        }

        return response()->json($project->load('files'), 201);
    }

    public function show($id)
    {
        $project = Project::with('files')->find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }
        return response()->json($project);
    }

    public function update(StoreProjectRequest $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $data = $request->validated();

        $fileIds = $data['files'] ?? [];
        unset($data['files']);

        $project->update($data);

        if (!empty($fileIds)) {
            $project->files()->sync($fileIds);
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
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }


}
