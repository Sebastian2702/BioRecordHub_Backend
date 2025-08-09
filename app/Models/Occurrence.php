<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occurrence extends Model
{
    protected $fillable = [
        'nomenclature_id',
        'project_id',
        'scientific_name',
        'event_date',
        'country',
        'locality',
        'decimal_latitude',
        'decimal_longitude',
        'basis_of_record',
        'occurrence_id',
        'contributors',
        'institution_code',
        'collection_code',
        'catalog_number',
        'recorded_by',
        'identified_by',
        'date_identified',
        'occurrence_remarks',
        'language',
        'license',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function nomenclature()
    {
        return $this->belongsTo(Nomenclature::class);
    }

    public function fields()
    {
        return $this->belongsToMany(OccurrenceField::class)->withPivot('value');
    }

    public function files()
    {
        return $this->hasMany(OccurrenceFiles::class);
    }
}
