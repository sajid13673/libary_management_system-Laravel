<?php

namespace App\Http\Requests;

use App\Enums\PaymentType;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class PaymentPostRequest extends FormRequest
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
            'amount' => ['required', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
            'fine_id' => ['integer', 'required'],
            'type' => ['required', new EnumValue(PaymentType::class, false)]
        ];
    }
}
