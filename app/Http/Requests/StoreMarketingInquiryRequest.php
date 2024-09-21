<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreMarketingInquiryRequest extends FormRequest
{
    use ApiResponse;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "title" => 'required',
            "name" => 'required',
            "username" => 'required',
            "email" => 'required|email',
            "phone" => 'required',
            "message" => 'required',
            "file" => 'required|mimes:pdf|max:10000',
            "country" => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }
}
