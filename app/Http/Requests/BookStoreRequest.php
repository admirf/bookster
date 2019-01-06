<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|integer',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'available' => 'sometimes|boolean',
            'isbn' => 'nullable|string|max:255',
            'edition' => 'nullable|string',
            'num_of_pages' => 'nullable|integer',
            'language' => 'required|string'
        ];
    }
}
