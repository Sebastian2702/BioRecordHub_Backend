<?php

namespace App\Exports;

use App\Models\Nomenclature;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NomenclatureExport implements FromCollection, WithHeadings, WithMapping
{
    protected $nomenclatures;

    /**
     * @param array $ids
     */
    public function __construct(array $ids)
    {
        $this->nomenclatures = Nomenclature::with('bibliographies')
            ->whereIn('id', $ids)
            ->get();
    }

    public function collection()
    {
        return $this->nomenclatures;
    }

    public function map($nomenclature): array
    {
        return [
            $nomenclature->id,
            $nomenclature->kingdom,
            $nomenclature->phylum,
            $nomenclature->subphylum,
            $nomenclature->class,
            $nomenclature->order,
            $nomenclature->suborder,
            $nomenclature->infraorder,
            $nomenclature->superfamily,
            $nomenclature->family,
            $nomenclature->subfamily,
            $nomenclature->tribe,
            $nomenclature->genus,
            $nomenclature->subgenus,
            $nomenclature->species,
            $nomenclature->subspecies,
            $nomenclature->author,
            $nomenclature->remarks,
            $nomenclature->contributors,
            $nomenclature->synonyms,
            $nomenclature->bibliographies->pluck('key')->join(', '),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kingdom',
            'Phylum',
            'Subphylum',
            'Class',
            'Order',
            'Suborder',
            'Infraorder',
            'Superfamily',
            'Family',
            'Subfamily',
            'Tribe',
            'Genus',
            'Subgenus',
            'Species',
            'Subspecies',
            'Author',
            'Remarks',
            'Contributors',
            'Synonyms',
            'Bibliography Keys',
        ];
    }
}
