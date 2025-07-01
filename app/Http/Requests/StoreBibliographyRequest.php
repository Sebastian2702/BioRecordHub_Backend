<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBibliographyRequest extends FormRequest
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
            'key' => 'required|string|max:255',
            'item_type' => 'required|string|max:255',
            'publication_year' => 'required|digits:4|integer',
            'author' => 'required|string',
            'title' => 'required|string',
            'publication_title' => 'required|string',
            'isbn' => 'nullable|string|max:255',
            'issn' => 'nullable|string|max:255',
            'doi' => 'nullable|string|max:255',
            'url' => 'nullable|url',
            'abstract_note' => 'nullable|string',
            'date' => 'required|digits:4|integer',
            'date_added' => 'nullable|date',
            'date_modified' => 'nullable|date',
            'access_date' => 'nullable|date',
            'pages' => 'nullable|string|max:255',
            'num_pages' => 'nullable|integer',
            'issue' => 'nullable|string|max:255',
            'volume' => 'nullable|string|max:255',
            'number_of_volumes' => 'nullable|string|max:255',
            'journal_abbreviation' => 'nullable|string|max:255',
            'short_title' => 'nullable|string|max:255',
            'series' => 'nullable|string|max:255',
            'series_number' => 'nullable|string|max:255',
            'series_text' => 'nullable|string|max:255',
            'series_title' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'place' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'rights' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'archive' => 'nullable|string|max:255',
            'archive_location' => 'nullable|string|max:255',
            'library_catalog' => 'nullable|string|max:255',
            'call_number' => 'nullable|string|max:255',
            'extra' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
