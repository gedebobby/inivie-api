<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyDetailRequest extends FormRequest
{
    use ApiResponse;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // "logo" => 'required',
            // "logo" => 'required',
            "logo" => 'required|image',
            "favicon" => 'required|',
            "star" => 'required',
            "meta_title" => 'required',
            "meta_keyword" => 'required',
            "meta_description" => 'required',
            "link_gmaps" => 'required',
            "address" => 'required',
            "slogan" => 'required',
            "description" => 'required',
            "yt_video" => 'required',
            "list_property_id" => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }
}
