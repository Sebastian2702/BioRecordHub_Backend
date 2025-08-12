<?php

namespace App\Exports;

use App\Models\Bibliography;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BibliographyExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bibliographies;

    /**
     * @param array $ids
     */
    public function __construct(array $ids)
    {

        $this->bibliographies = Bibliography::whereIn('id', $ids)->get();
    }

    public function collection()
    {
        return $this->bibliographies;
    }

    public function map($bib): array
    {
        return [
            $bib->id,
            $bib->key,
            $bib->item_type,
            $bib->publication_year,
            $bib->author,
            $bib->title,
            $bib->publication_title,
            $bib->isbn,
            $bib->issn,
            $bib->doi,
            $bib->url,
            $bib->abstract_note,
            $bib->date,
            $bib->date_added,
            $bib->date_modified,
            $bib->access_date,
            $bib->pages,
            $bib->num_pages,
            $bib->issue,
            $bib->volume,
            $bib->number_of_volumes,
            $bib->journal_abbreviation,
            $bib->short_title,
            $bib->series,
            $bib->series_number,
            $bib->series_text,
            $bib->series_title,
            $bib->publisher,
            $bib->place,
            $bib->language,
            $bib->rights,
            $bib->type,
            $bib->archive,
            $bib->archive_location,
            $bib->library_catalog,
            $bib->call_number,
            $bib->extra,
            $bib->notes,
            $bib->contributors,
            $bib->verified,
            $bib->file,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Key',
            'Item Type',
            'Publication Year',
            'Author',
            'Title',
            'Publication Title',
            'ISBN',
            'ISSN',
            'DOI',
            'URL',
            'Abstract Note',
            'Date',
            'Date Added',
            'Date Modified',
            'Access Date',
            'Pages',
            'Num Pages',
            'Issue',
            'Volume',
            'Number of Volumes',
            'Journal Abbreviation',
            'Short Title',
            'Series',
            'Series Number',
            'Series Text',
            'Series Title',
            'Publisher',
            'Place',
            'Language',
            'Rights',
            'Type',
            'Archive',
            'Archive Location',
            'Library Catalog',
            'Call Number',
            'Extra',
            'Notes',
            'Contributors',
            'Verified',
            'File',
        ];
    }
}
