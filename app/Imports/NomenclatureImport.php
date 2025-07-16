<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Arr;
use App\Models\Bibliography;
class NomenclatureImport implements ToCollection
{
    protected $mappedData;

    public function collection(Collection $rows)
    {
        $headers = $rows->first()->toArray();

        $this->mappedData = $rows->skip(1)->map(function ($row) use ($headers) {
            $rowArray = $row->toArray();

            if (count($rowArray) !== count($headers)) {
                return null;
            }

            $rowAssoc = array_combine($headers, $rowArray);

            // Extract bibliography keys
            $bibliographyKeys = collect($rowAssoc)
                ->filter(fn($v, $k) => str_starts_with($k, 'bibliography_key') && !empty($v))
                ->values()
                ->toArray();

            // Lookup their IDs
            $bibliographyIds = Bibliography::whereIn('key', $bibliographyKeys)
                ->pluck('id', 'key')
                ->toArray();

            // Return the resolved IDs in the original order
            $resolvedIds = collect($bibliographyKeys)
                ->map(fn($key) => $bibliographyIds[$key] ?? null)
                ->filter()
                ->values()
                ->toArray();

            $nomenclatureData = Arr::except($rowAssoc, array_filter($headers, fn($h) => str_starts_with($h, 'bibliography_key')));

            return array_merge($nomenclatureData, ['bibliography_ids' => $resolvedIds,]);

        })->filter()->values();
    }

    public function getMappedData()
    {
        return $this->mappedData;
    }
}

