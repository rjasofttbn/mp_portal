<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            $response['status'] = 'success';
            $response['message'] = 'Successfully Login';
            $response['api_info']    = $this->respondWithToken($token);
            return response()->json($response);
        }

        $response['status'] = 'error';
        $response['message'] = 'Email or Password not Correct';
        return response()->json($response);
        
    }

    public function logout()
    {
        $this->guard()->logout();
        $response['status'] = 'success';
        $response['message'] = 'Successfully logged out';
        return response()->json($response);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => (auth('api')->factory()->getTTL() * 60),
            'user' => auth('api')->user()
        ]);
    }
    
    public function guard()
    {
        return Auth::guard('api');
    }
}