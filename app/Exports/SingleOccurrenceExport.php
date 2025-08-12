<?php

namespace App\Exports;

use App\Models\Occurrence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SingleOccurrenceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $occurrence;
    protected $fieldNames;

    public function __construct($occurrenceId)
    {
        // Eager load nomenclature and project
        $this->occurrence = Occurrence::with(['fields', 'nomenclature', 'project'])
            ->findOrFail($occurrenceId);

        $this->fieldNames = $this->occurrence->fields
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    }

    public function collection()
    {
        return collect([$this->occurrence]);
    }

    public function map($occurrence): array
    {
        $row = [
            $occurrence->id,
            $occurrence->scientific_name,
            $occurrence->nomenclature->species,
            $occurrence->project->title,
            $occurrence->event_date,
            $occurrence->decimal_latitude,
            $occurrence->decimal_longitude,
            $occurrence->country,
            $occurrence->locality,
            $occurrence->recorded_by,
            $occurrence->institution_code,
            $occurrence->collection_code,
            $occurrence->catalog_number,
            $occurrence->basis_of_record,
            $occurrence->identified_by,
            $occurrence->date_identified,
            $occurrence->occurrence_remarks,
        ];

        foreach ($this->fieldNames as $fieldName) {
            $fieldValue = optional(
                $occurrence->fields->firstWhere('name', $fieldName)
            )->pivot->value ?? '';
            $row[] = $fieldValue;
        }

        return $row;
    }

    public function headings(): array
    {
        $baseHeadings = [
            'Occurrence ID',
            'Scientific Name',
            'Species',
            'Project Title',
            'Event Date',
            'Latitude',
            'Longitude',
            'Country',
            'Locality',
            'Recorded By',
            'Institution Code',
            'Collection Code',
            'Catalog Number',
            'Basis of Record',
            'Identified By',
            'Identification Date',
            'Remarks',
        ];

        return array_merge($baseHeadings, $this->fieldNames);
    }
}
