<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OccurrenceFiles extends Model
{
    protected $table = 'occurrence_files';
    protected $fillable = ['filename', 'path', 'occurrence_id'];

    public function occurrence()
    {
        return $this->belongsTo(Occurrence::class);
    }
}
