<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Project extends Model
{
    protected $fillable = [
        'title',
        'research_type',
        'department',
        'course',
        'advisor',
        'description',
    ];

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(ProjectFile::class);
    }
}
