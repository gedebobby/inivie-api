<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreHireRequest extends FormRequest
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
            "list_property_job_id" => 'required',
            "job_position_id" => 'required',
            "work_time" => 'required',
            "description" => 'required',
            "salary1" => 'string',
            "salary2" => 'string',
            "status" => 'required',
            "expired" => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->ValidationError($validator);
    }
}
