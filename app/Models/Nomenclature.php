<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomenclature extends Model
{
    use HasFactory;

    protected $fillable = [
        'kingdom',
        'phylum',
        'subphylum',
        'class',
        'order',
        'suborder',
        'infraorder',
        'superfamily',
        'family',
        'subfamily',
        'tribe',
        'genus',
        'subgenus',
        'species',
        'subspecies',
        'author',
        'remarks',
        'contributors',
        'synonyms',
    ];

    /**
     * Many-to-Many relationship with Bibliography
     */
    public function bibliographies()
    {
        return $this->belongsToMany(Bibliography::class);
    }

    public function images()
    {
        return $this->hasMany(NomenclatureImage::class); // or however you name the related model
    }
}
