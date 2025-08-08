<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OccurrenceField;

class OccurrenceFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            // Geographic
            [
                'name' => 'latitude',
                'label' => 'The Latitude where the occurrence was recorded',
                'type' => 'text',
                'is_required' => true,
                'group' => 'geographic',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'longitude',
                'label' => 'The Longitude where the occurrence was recorded',
                'type' => 'text',
                'is_required' => true,
                'group' => 'geographic',
                'is_active' => true,
                'options' => null,
            ],

            // Event
            [
                'name' => 'event_date',
                'label' => 'Date of the occurrence event',
                'type' => 'date',
                'is_required' => true,
                'group' => 'event',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'sampling_protocol',
                'label' => 'Sampling protocol used during event',
                'type' => 'text',
                'is_required' => false,
                'group' => 'event',
                'is_active' => true,
                'options' => null,
            ],

            // Occurrence
            [
                'name' => 'occurrence_status',
                'label' => 'Whether the occurrence is present or absent',
                'type' => 'text',
                'is_required' => false,
                'group' => 'occurrence',
                'is_active' => true,
                'options' => json_encode(['present', 'absent']),
            ],
            [
                'name' => 'individual_count',
                'label' => 'Number of individuals observed',
                'type' => 'number',
                'is_required' => false,
                'group' => 'occurrence',
                'is_active' => true,
                'options' => null,
            ],

            // Organism
            [
                'name' => 'organism_quantity',
                'label' => 'Quantity of the organism recorded',
                'type' => 'number',
                'is_required' => false,
                'group' => 'organism',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'life_stage',
                'label' => 'Life stage of the organism',
                'type' => 'text',
                'is_required' => false,
                'group' => 'organism',
                'is_active' => true,
                'options' => json_encode(['adult', 'juvenile', 'larva']),
            ],

            // Identification
            [
                'name' => 'identified_by',
                'label' => 'Person who identified the organism',
                'type' => 'text',
                'is_required' => false,
                'group' => 'identification',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'identification_remarks',
                'label' => 'Remarks about the identification',
                'type' => 'text',
                'is_required' => false,
                'group' => 'identification',
                'is_active' => true,
                'options' => null,
            ],

            // Collection
            [
                'name' => 'collector_name',
                'label' => 'Name of the collector',
                'type' => 'text',
                'is_required' => false,
                'group' => 'collection',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'sample_type',
                'label' => 'Type of sample collected',
                'type' => 'text',
                'is_required' => false,
                'group' => 'collection',
                'is_active' => true,
                'options' => null,
            ],

            // Dataset
            [
                'name' => 'project_code',
                'label' => 'Code of the associated project',
                'type' => 'text',
                'is_required' => false,
                'group' => 'dataset',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'dataset_name',
                'label' => 'Name of the dataset',
                'type' => 'text',
                'is_required' => false,
                'group' => 'dataset',
                'is_active' => true,
                'options' => null,
            ],

            // Record-level
            [
                'name' => 'record_number',
                'label' => 'Unique record number',
                'type' => 'text',
                'is_required' => false,
                'group' => 'record',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'record_created',
                'label' => 'Date the record was created',
                'type' => 'date',
                'is_required' => false,
                'group' => 'record',
                'is_active' => true,
                'options' => null,
            ],

            // Location
            [
                'name' => 'elevation',
                'label' => 'Elevation at the site of occurrence',
                'type' => 'number',
                'is_required' => false,
                'group' => 'location',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'habitat',
                'label' => 'Habitat description',
                'type' => 'text',
                'is_required' => false,
                'group' => 'location',
                'is_active' => true,
                'options' => null,
            ],

            // Other
            [
                'name' => 'notes',
                'label' => 'Additional notes',
                'type' => 'text',
                'is_required' => false,
                'group' => 'other',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'external_id',
                'label' => 'External system ID',
                'type' => 'text',
                'is_required' => false,
                'group' => 'other',
                'is_active' => true,
                'options' => null,
            ],
        ];

        foreach ($fields as $field) {
            OccurrenceField::create($field);
        }
    }


}
