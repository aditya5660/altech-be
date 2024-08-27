<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // API login with email and password validation
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::formError('Form validation error', $validator->errors(), 400);
        }

        $credentials = $request->only('email', 'password');
        $result = $this->authService->login($credentials);

        if ($result['status']) {
            return ApiResponseHelper::success('Login success', [
                'user' => $result['user'],
                'token' => $result['token'],
            ]);
        }

        return ApiResponseHelper::error($result['message'], [], 401);
    }

    // Register user with validation directly in the controller
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseHelper::formError('Form validation error', $validator->errors(), 400);
        }

        $data = $request->only('name', 'email', 'password');
        $result = $this->authService->register($data);

        if ($result['status']) {
            return ApiResponseHelper::success('Register success', ['user' => $result['user']]);
        }

        return ApiResponseHelper::error($result['message'], ['error' => $result['error']], 500);
    }
}
