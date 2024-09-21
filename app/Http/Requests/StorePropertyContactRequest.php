<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyContactRequest extends FormRequest
{
    use ApiResponse;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "whatsapp" => 'required',
            "email" => 'required',
            "phone" => 'required',
            "booking_link" => 'required',
            "whatsapp_link" => 'required',
            "instagram" => 'required',
            "facebook" => 'required',
            "youtube" => 'required',
            "trip_advisor" => 'required',
            "tiktok_link" => 'required',
            "google_link" => 'required',
            "tripadvisor_link" => 'required',
            "list_property_id" => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }
}
