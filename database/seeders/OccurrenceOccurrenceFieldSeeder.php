<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Occurrence;
use App\Models\OccurrenceField;

class OccurrenceOccurrenceFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $occurrences = Occurrence::all();
        $fields = OccurrenceField::all();

        foreach ($occurrences as $occurrence) {
            // Randomly attach 1 to 3 fields with fake values
            $randomFields = $fields->random(min(3, $fields->count()));

            foreach ($randomFields as $field) {
                DB::table('occurrence_occurrence_field')->insert([
                    'occurrence_id' => $occurrence->id,
                    'occurrence_field_id' => $field->id,
                    'value' => $this->generateFakeValue($field->type),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function generateFakeValue($type)
    {
        return match ($type) {
            'text' => 'Example text',
            'number' => rand(1, 100),
            'date' => now()->toDateString(),
            'boolean' => rand(0, 1),
            'select' => 'Option A',
            default => 'N/A',
        };
    }
}
