<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyThemeRequest extends FormRequest
{
    use ApiResponse;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "old_color" => 'required',
            "header_color" => 'required',
            "body_color" => 'required',
            "line_color" => 'required',
            "footer_color" => 'required',
            "button_line_top" => 'required',
            "button_hover" => 'required',
            "list_property_id" => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }
}
