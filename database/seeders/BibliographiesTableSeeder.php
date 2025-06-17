<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bibliography;

class BibliographiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bibliography::firstOrCreate(
            ['key' => 'UHTFJJXJ'],
            [
            'item_type' => 'Journal Article',
            'publication_year' => 1971,
            'author' => 'Diabola, J.',
            'title' => 'Taxonomische und Chorologische Ergünzungen der zikadenfauna von Anatolien, Iran, Afghanistan und Pakistan (Homoptera, Auchenorrhyncha)',
            'publication_title' => 'Acta Entomologica Bohemoslovaca',
            'isbn' => null,
            'issn' => null,
            'doi' => null,
            'url' => null,
            'abstract_note' => null,
            'date' => '1971-01-01',
            'date_added' => '2017-05-01 10:58:00',
            'date_modified' => '2023-08-03 23:28:00',
            'access_date' => null,
            'pages' => '377-396',
            'num_pages' => null,
            'issue' => null,
            'volume' => '6',
            'number_of_volumes' => '68',
            'journal_abbreviation' => 'Acta Entomol Bohemoslov',
            'short_title' => null,
            'series' => null,
            'series_number' => null,
            'series_text' => null,
            'series_title' => null,
            'publisher' => null,
            'place' => null,
            'language' => null,
            'rights' => null,
            'type' => null,
            'archive' => null,
            'archive_location' => null,
            'library_catalog' => null,
            'call_number' => null,
            'extra' => null,
            'notes' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Bibliography::firstOrCreate(
            ['key' => 'XNT6GVCQ'],
            [
            'item_type' => 'Journal Article',
            'publication_year' => 1996,
            'author' => 'Ashmole, N. P.; Oromí, P.; Ashmole, M. J.; Martín, J. L.',
            'title' => 'The invertebrate fauna of early successional volcanic habitats in the Azores',
            'publication_title' => 'Boletim do Museu Municipal do Funchal',
            'isbn' => null,
            'issn' => null,
            'doi' => null,
            'url' => null,
            'abstract_note' => null,
            'date' => '1971-01-01',
            'date_added' => '2017-05-01 10:58:00',
            'date_modified' => '2023-08-03 23:28:00',
            'access_date' => null,
            'pages' => '377-396',
            'num_pages' => null,
            'issue' => null,
            'volume' => '6',
            'number_of_volumes' => '68',
            'journal_abbreviation' => 'Acta Entomol Bohemoslov',
            'short_title' => null,
            'series' => null,
            'series_number' => null,
            'series_text' => null,
            'series_title' => null,
            'publisher' => null,
            'place' => null,
            'language' => null,
            'rights' => null,
            'type' => null,
            'archive' => null,
            'archive_location' => null,
            'library_catalog' => null,
            'call_number' => null,
            'extra' => null,
            'notes' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Bibliography::firstOrCreate(
            ['key' => '9SHWK2BP'],
            [
            'item_type' => 'Journal Article',
            'publication_year' => 1960,
            'author' => 'Lindberg, H.',
            'title' => 'Hemiptera from the Azores and Madeira',
            'publication_title' => 'Boletim do Museu Municipal do Funchal',
            'isbn' => null,
            'issn' => null,
            'doi' => null,
            'url' => null,
            'abstract_note' => null,
            'date' => '1971-01-01',
            'date_added' => '2017-05-01 10:58:00',
            'date_modified' => '2023-08-03 23:28:00',
            'access_date' => null,
            'pages' => '377-396',
            'num_pages' => null,
            'issue' => null,
            'volume' => '6',
            'number_of_volumes' => '68',
            'journal_abbreviation' => 'Acta Entomol Bohemoslov',
            'short_title' => null,
            'series' => null,
            'series_number' => null,
            'series_text' => null,
            'series_title' => null,
            'publisher' => null,
            'place' => null,
            'language' => null,
            'rights' => null,
            'type' => null,
            'archive' => null,
            'archive_location' => null,
            'library_catalog' => null,
            'call_number' => null,
            'extra' => null,
            'notes' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
