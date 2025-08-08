<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OccurrenceField extends Model
{
    protected $fillable = [
        'name',
        'label',
        'type',
        'group',
        'is_required',
        'is_active',
        'options',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
        'options' => 'array',
    ];

    public function occurrences()
    {
        return $this->belongsToMany(Occurrence::class)->withPivot('value');
    }
}



