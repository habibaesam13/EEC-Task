<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditPharmacy extends FormRequest
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
            'name'=> [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('pharmacies', 'name')->ignore(
                    $this->route('pharmacy')->id
                ),
            ],
            'address'=>'sometimes|string',
        ];
    }
    public function messages(): array
    {
        return [
            
            'name.unique'         => 'This Pharmacy name already exists.',
            'name.string'         => 'Pharmacy name must be a valid string.',
            'name.max'            => 'Pharmacy name cannot exceed 255 characters.',

            'address.string'         => 'Pharmacy address must be a valid string.',
        ];
    }
}
