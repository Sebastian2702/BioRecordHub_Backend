<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFile extends Model
{
    protected $table = 'project_files';
    protected $fillable = ['filename', 'path', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
