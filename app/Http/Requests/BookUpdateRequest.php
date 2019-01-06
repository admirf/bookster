<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'sometimes|integer|exists:categories,id',
            'price' => 'sometimes|integer',
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'available' => 'sometimes|boolean',
            'isbn' => 'sometimes|string|max:255',
            'edition' => 'sometimes|string',
            'num_of_pages' => 'sometimes|integer',
            'language' => 'sometimes|string'
        ];
    }
}
