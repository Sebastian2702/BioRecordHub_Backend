<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BibliographyImport implements ToCollection
{
    protected $mappedData;

    public function collection(Collection $rows)
    {
        $headers = [
            'key', 'item_type', 'publication_year', 'author', 'title',
            'publication_title', 'isbn', 'issn', 'doi', 'url',
            'abstract_note', 'date', 'date_added', 'date_modified', 'access_date',
            'pages', 'num_pages', 'issue', 'volume', 'number_of_volumes',
            'journal_abbreviation', 'short_title', 'series', 'series_number',
            'series_text', 'series_title', 'publisher', 'place', 'language',
            'rights', 'type', 'archive', 'archive_location', 'library_catalog',
            'call_number', 'extra', 'notes',
        ];

        $this->mappedData = $rows->skip(1)->map(function ($row) use ($headers) {
            $rowArray = $row->toArray();

            if (count($rowArray) !== count($headers)) {
                return null;
            }

            return array_combine($headers, $rowArray);
        })->filter()->values();
    }

    public function getMappedData()
    {
        return $this->mappedData;
    }
}
