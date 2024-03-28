<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|required|max:50',
            'author' =>'string|required|max:50',
            'publisher' =>'string|required|max:50',
            'year' =>'numeric|required|digits:4',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'status' =>'boolean',
        ];
    }
}
