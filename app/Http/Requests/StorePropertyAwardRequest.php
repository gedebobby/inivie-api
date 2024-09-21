<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyAwardRequest extends FormRequest
{
    use ApiResponse;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "image" => 'required|image',
            "link" => 'required',
            "list_property_id" => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }
}
