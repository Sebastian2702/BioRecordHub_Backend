<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Http\Requests\StoreProjectRequest;

class ProjectController extends Controller
{
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
}
