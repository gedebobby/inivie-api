<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePropertyRequest extends FormRequest
{
    use ApiResponse;
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
            "images" => 'required',
            "images_id" => 'required',
            "images_path" => 'required',
            "title" => 'required',
            "desc" => 'required',
            "reservation" => 'required',
            "phone" => 'required',
            "address" => 'required',
            "email" => 'required|email',
            "website" => 'required',
            "booking_link" => 'required',
            "property_type_id" => 'required',
            "property_area_id" => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }

}
