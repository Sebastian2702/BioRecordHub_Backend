<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFile extends Model
{
    protected $fillable = ['filename', 'path'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
