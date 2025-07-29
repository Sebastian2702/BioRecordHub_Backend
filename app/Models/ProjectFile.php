<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $fillable = ['filename', 'path'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
