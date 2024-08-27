<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $credentials)
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user) {
            return ['status' => false, 'message' => 'User not found'];
        }

        if (Auth::attempt($credentials)) {
            $token = $user->createToken('authToken')->plainTextToken;
            return ['status' => true, 'user' => $user, 'token' => $token];
        }

        return ['status' => false, 'message' => 'Login failed'];
    }

    public function register(array $data)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => 'user',
                'is_active' => true,
                'password' => bcrypt($data['password']),
            ]);
            DB::commit();
            return ['status' => true, 'user' => $user];
        } catch (Exception $e) {
            DB::rollBack();
            return ['status' => false, 'message' => 'Register failed', 'error' => $e->getMessage()];
        }
    }
}
