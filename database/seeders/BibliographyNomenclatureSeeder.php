<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bibliography;
use App\Models\Nomenclature;

class BibliographyNomenclatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nomenclature = Nomenclature::first();
        $bibliography = Bibliography::first();

        $nomenclature->bibliographies()->attach($bibliography->id);
    }
}
