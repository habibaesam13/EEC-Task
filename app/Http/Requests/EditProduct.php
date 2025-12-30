<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditProduct extends FormRequest
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
            'title' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('products', 'title')->ignore(
                    $this->route('product')->product_id
                ),
            ],
            'description' => 'sometimes|string|min:10',
            'image'       => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'price'       => 'sometimes|numeric|min:0.01',
            'quantity'    => 'sometimes|integer|min:1|max:10000',
        ];
    }

    public function messages(): array
    {
        return [

            'title.unique'         => 'This product title already exists.',
            'title.string'         => 'Product title must be a valid string.',
            'title.max'            => 'Product title cannot exceed 255 characters.',


            'description.string'   => 'Product description must be text.',
            'description.min'      => 'Product description must be at least 10 characters.',

            'image.image'          => 'The uploaded file must be an image.',
            'image.mimes'          => 'Allowed image formats: jpeg, png, jpg, gif, svg, webp.',
            'image.max'            => 'Image size must not exceed 2MB.',


            'price.numeric'        => 'Product price must be a valid number.',
            'price.min'            => 'Product price must be greater than 0.',


            'quantity.integer'     => 'Product quantity must be a number.',
            'quantity.min'         => 'Product quantity must be at least 1.',
            'quantity.max'         => 'Product quantity cannot exceed 10,000.',
        ];
    }
}
