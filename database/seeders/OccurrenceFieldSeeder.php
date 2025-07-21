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
            [
                'name' => 'latitude',
                'label' => 'The Latitude that the occurrence was collected at',
                'type' => 'text',
                'is_required' => true,
                'group' => 'geographic',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'longitude',
                'label' => 'The Longitude that the occurrence was collected at',
                'type' => 'text',
                'is_required' => true,
                'group' => 'geographic',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'collector_name',
                'label' => 'Collector Name',
                'type' => 'text',
                'is_required' => false,
                'group' => 'collection',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'sample_type',
                'label' => 'Sample Type',
                'type' => 'text',
                'is_required' => false,
                'group' => 'collection',
                'is_active' => true,
                'options' => null,
            ],
            [
                'name' => 'project_code',
                'label' => 'Project Code',
                'type' => 'text',
                'is_required' => false,
                'group' => 'dataset',
                'is_active' => true,
                'options' => null,
            ],
        ];

        foreach ($fields as $field) {
            OccurrenceField::create($field);
        }
    }

}
