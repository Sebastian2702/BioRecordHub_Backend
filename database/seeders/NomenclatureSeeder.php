<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nomenclature;

class NomenclatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nomenclature::create([
            'kingdom' => 'Animalia',
            'phylum' => 'Arthropoda',
            'subphylum' => 'Hexapoda',
            'class' => 'Insecta',
            'order' => 'Diptera',
            'suborder' => 'Nematocera',
            'infraorder' => 'Tipulomorpha',
            'superfamily' => 'Tipuloidea',
            'family' => 'Tipulidae',
            'subfamily' => 'Tipulinae',
            'tribe' => null,
            'genus' => 'Tipula',
            'subgenus' => 'Acutipula',
            'species' => 'Tipula paludosa',
            'subspecies' => null,
            'author' => 'Meigen, 1830',
            'remarks' => 'Example record for testing',
        ]);
    }
}
