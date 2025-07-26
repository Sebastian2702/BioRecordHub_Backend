<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNomenclatureRequest extends FormRequest
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
            'kingdom' => 'required|string',
            'phylum' => 'required|string',
            'subphylum' => 'required|string',
            'class' => 'required|string',
            'order' => 'required|string',
            'suborder' => 'required|string',
            'infraorder' => 'required|string',
            'superfamily' => 'required|string',
            'family' => 'required|string',
            'subfamily' => 'nullable|string',
            'tribe' => 'nullable|string',
            'genus' => 'nullable|string',
            'subgenus' => 'nullable|string',
            'species'=> 'required|string',
            'subspecies' => 'nullable|string',
            'author' => 'required|string',
            'remarks' => 'nullable|string',
            'contributors' => 'required|string',
            'synonyms' => 'nullable|string',
            'images' => 'nullable|array',
            'bibliographies' => 'sometimes|array',
            'bibliographies.*' => 'exists:bibliographies,id',
        ];
    }
}
