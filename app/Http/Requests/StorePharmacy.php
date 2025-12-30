<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacy extends FormRequest
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
            'name'=>'required|string|max:255|unique:pharmacies,name',
            'address'=>'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'       => 'Pharmacy name is required.',
            'name.unique'         => 'This Pharmacy name already exists.',
            'name.string'         => 'Pharmacy name must be a valid string.',
            'name.max'            => 'Pharmacy name cannot exceed 255 characters.',

            'address.required'       => 'Pharmacy address is required.',
            'address.string'         => 'Pharmacy address must be a valid string.',
        ];
    }
}
