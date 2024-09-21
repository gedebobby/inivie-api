<?php 

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiResponse {

    protected function Success($data, string $msg, int $code = 200) {
        return response()->json([
            'status' => 'Success',
            'message' => $msg,
            'data' => $data
        ], $code);
    }

    protected function Error(string $message = null, int $code)
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
        ], $code);
    }

    protected function ValidationError($validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true,
            ], 422));
    }
}

?>