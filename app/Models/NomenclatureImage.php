<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NomenclatureImage extends Model
{
    protected $fillable = ['filename', 'path'];

    public function nomenclature()
    {
        return $this->belongsTo(Nomenclature::class);
    }
}
