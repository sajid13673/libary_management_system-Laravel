<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPostRequest extends FormRequest
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
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'name' =>'string|required|max:50',
            'phone_number' =>'required|numeric|digits:10|unique:members,phone_number',
            'address' =>'required|string',
            'password_confirmation' =>'required',
        ];
    }
}
