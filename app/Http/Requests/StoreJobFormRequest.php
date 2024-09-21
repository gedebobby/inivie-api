<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreJobFormRequest extends FormRequest
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
            "phone" => 'required',
            "email" => 'required|email',
            "date_of_birth" => 'required',
            "hire_id" => 'required',
            "cover_letter" => 'required',
            "file" => 'required|mimes:pdf|max:10000'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }
}
