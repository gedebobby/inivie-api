<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriberRequest extends FormRequest
{
    use ApiResponse;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => 'required',
            "email" => 'required|email',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }
}
