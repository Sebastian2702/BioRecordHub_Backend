<?php

namespace App\Exports;

use App\Models\Occurrence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OccurrencesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $fieldNames;

    public function __construct()
    {
        $allOccurrences = Occurrence::with('fields')->get();
        $this->fieldNames = $allOccurrences
            ->flatMap(function ($occurrence) {
                return $occurrence->fields->pluck('name');
            })
            ->unique()
            ->values()
            ->toArray();

        $this->occurrences = $allOccurrences;
    }

    public function collection()
    {
        return $this->occurrences;
    }

    public function map($occurrence): array
    {
        $row = [
            $occurrence->id,
            $occurrence->scientific_name,
            $occurrence->evenet_date,
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
