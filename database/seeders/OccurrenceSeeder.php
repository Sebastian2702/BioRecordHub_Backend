<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Occurrence;

class OccurrenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sampleOccurrences = [
            [
                'nomenclature_id' => 92,
                'project_id' => 7,
                'scientific_name' => 'Panthera leo',
                'event_date' => '2024-05-21',
                'country' => 'Kenya',
                'locality' => 'Maasai Mara',
                'decimal_latitude' => -1.4061,
                'decimal_longitude' => 35.0023,
                'basis_of_record' => 'HumanObservation',
                'occurrence_id' => 'occ-001',
            ],
            [
                'nomenclature_id' => 93,
                'project_id' => 8,
                'scientific_name' => 'Quercus robur',
                'event_date' => '2023-09-15',
                'country' => 'Portugal',
                'locality' => 'Sintra',
                'decimal_latitude' => 38.8029,
                'decimal_longitude' => -9.3817,
                'basis_of_record' => 'PreservedSpecimen',
                'occurrence_id' => 'occ-002',
            ],
            [
                'nomenclature_id' => 94,
                'project_id' => 9,
                'scientific_name' => 'Rana temporaria',
                'event_date' => '2024-03-10',
                'country' => 'Germany',
                'locality' => 'Black Forest',
                'decimal_latitude' => 48.0646,
                'decimal_longitude' => 8.2415,
                'basis_of_record' => 'FossilSpecimen',
                'occurrence_id' => 'occ-003',
            ],
        ];

        foreach ($sampleOccurrences as $occurrence) {
            Occurrence::create($occurrence);
        }
    }
}
