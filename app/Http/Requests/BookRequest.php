<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'name' => 'required|string',
            'release_date' => 'required|date',
            'authors' => 'required|array|min:1',
            'authors.*' => 'required|string|min:3',
            'isbn' => 'required|string',
            'number_of_pages' => 'required|numeric',
            'publisher' => 'required|string',
            'country' => 'required|string'
        ];
    }
}
