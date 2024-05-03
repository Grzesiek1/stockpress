<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function unauthorizedMessage(): string
    {
        return __('Unauthorized');
    }

    public function messages(): array
    {
        return [];
    }

    protected function failedValidation(Validator $validator)
    {
        // remove exception on validation
    }

    protected function failedAuthorization()
    {
        // remove default authorization exception
    }

    public abstract function rules(): array;
}
