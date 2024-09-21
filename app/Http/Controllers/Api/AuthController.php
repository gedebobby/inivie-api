<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;

    public function index() {
        return 'sasfsdfd';
    }

    public function register(RegisterRequest $request) {
        $validated = $request->validated();
        $data = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        return $this->Success($data, 'Register Success');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($credentials)) {
            return $this->Error('Login Invalid', 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;    
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function user(){
        if (Auth::check()) {
            $user = Auth::user();
            return Response(['data' => $user],200);
        }
        return Response(['data' => 'Unauthorized'],401);
    }

    public function logout(){
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        
        return Response(['data' => 'User Logout successfully.'],200);
    }
}
