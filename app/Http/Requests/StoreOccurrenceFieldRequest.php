<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOccurrenceFieldRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'type' => [
                'required',
                Rule::in(['text', 'textarea', 'select', 'number', 'date']),
            ],
            'section' => [
                'required',
                Rule::in(['geographic', 'collection', 'dataset', 'other']),
            ],
            'is_required' => 'boolean',
            'is_active' => 'boolean',
            'options' => 'nullable|array',
            'options.*' => 'string'
        ];
    }
}
