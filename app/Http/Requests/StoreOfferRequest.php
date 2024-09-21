<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            "description" => 'required',
            "booking_link" => 'required',
            "photo" => 'required|image',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }
}
