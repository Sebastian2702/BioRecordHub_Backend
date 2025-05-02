<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibliography extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'item_type',
        'publication_year',
        'author',
        'title',
        'publication_title',
        'isbn',
        'issn',
        'doi',
        'url',
        'abstract_note',
        'date',
        'date_added',
        'date_modified',
        'access_date',
        'pages',
        'num_pages',
        'issue',
        'volume',
        'number_of_volumes',
        'journal_abbreviation',
        'short_title',
        'series',
        'series_number',
        'series_text',
        'series_title',
        'publisher',
        'place',
        'language',
        'rights',
        'type',
        'archive',
        'archive_location',
        'library_catalog',
        'call_number',
        'extra',
        'notes',
    ];

    /**
     * Many-to-Many relationship with Nomenclature
     */
    public function nomenclatures()
    {
        return $this->belongsToMany(Nomenclature::class);
    }
}
