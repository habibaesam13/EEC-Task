<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255|unique:products,title',
            'description' => 'required|string|min:10',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'price'       => 'required|numeric|min:0.01',
            'quantity'    => 'required|integer|min:1|max:10000',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Product title is required.',
            'title.unique'         => 'This product title already exists.',
            'title.string'         => 'Product title must be a valid string.',
            'title.max'            => 'Product title cannot exceed 255 characters.',

            'description.required' => 'Product description is required.',
            'description.string'   => 'Product description must be text.',
            'description.min'      => 'Product description must be at least 10 characters.',

            'image.image'          => 'The uploaded file must be an image.',
            'image.mimes'          => 'Allowed image formats: jpeg, png, jpg, gif, svg, webp.',
            'image.max'            => 'Image size must not exceed 2MB.',

            'price.required'       => 'Product price is required.',
            'price.numeric'        => 'Product price must be a valid number.',
            'price.min'            => 'Product price must be greater than 0.',

            'quantity.required'    => 'Product quantity is required.',
            'quantity.integer'     => 'Product quantity must be a number.',
            'quantity.min'         => 'Product quantity must be at least 1.',
            'quantity.max'         => 'Product quantity cannot exceed 10,000.',
        ];
    }
}
