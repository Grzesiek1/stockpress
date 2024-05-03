<?php
declare(strict_types=1);

namespace App\Http\Requests;

class FileManagerRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image|max:5120|mimes:jpeg,png,webp,tiff,bmp|dimensions:min_width=500,min_height=500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('Name is required'),
            'email.required' => __('Email is required'),
            'image.required' => __('Image is required'),
            'image.max' => __('Image may not be greater than 5MB'),
            'image.mimes' => __('Image must be jpeg, png, webp, tiff, bmp'),
            'image.dimensions' => __('Image may not be smaller than 500px'),
        ];
    }
}
