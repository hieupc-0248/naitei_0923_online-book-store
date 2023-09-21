<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'publisher' => 'required|string|max:255',
            'publisher_year' => 'required|integer|min:1900|max:' . date('Y'),
            'author' => 'required|string|max:255',
            'page_nums' => 'required|integer|min:1',
            'category.*' => 'exists:categories,id',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
