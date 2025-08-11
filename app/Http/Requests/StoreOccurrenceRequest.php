<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOccurrenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomenclature_id'   => 'required|exists:nomenclatures,id',
            'project_id'        => 'required|exists:projects,id',

            'scientific_name'   => 'required|string|max:255',
            'event_date'        => 'required|date',
            'country'           => 'nullable|string|max:255',
            'locality'          => 'nullable|string|max:255',
            'decimal_latitude'  => 'nullable|numeric|between:-90,90',
            'decimal_longitude' => 'nullable|numeric|between:-180,180',
            'basis_of_record'   => 'nullable|string|max:255',
            'contributors'      => 'required|string',
            'institution_code' => 'required|string',
            'collection_code' => 'required|string',
            'catalog_number' => 'required|string',
            'recorded_by' => 'required|string',
            'identified_by' => 'required|string',
            'date_identified' => 'required|string',
            'occurrence_remarks'  => 'required|string',
            'language'  => 'required|string',
            'license'  => 'required|string',


            'fields.*.id'       => 'required|exists:occurrence_fields,id',
            'fields.*.value'    => 'nullable|string',
            'files.*'           => 'file|max:10240',
        ];
    }
}
