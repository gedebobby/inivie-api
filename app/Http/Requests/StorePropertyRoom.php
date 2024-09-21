<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRoom extends FormRequest
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
            "bed_size" => 'required',
            "room_size" => 'required',
            "max_occupancy" => 'required',
            "description" => 'required',
            "photo" => 'image',
            "list_property_id" => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }
}
