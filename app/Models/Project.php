<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Project extends Model
{
    protected $fillable = [
        'title',
        'research_type',
        'department',
        'course',
        'advisor',
        'description',
        'creator',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(ProjectFile::class);
    }
}
