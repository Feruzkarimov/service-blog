<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreatedRequest;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class AuthController extends Controller
{
    public function register(UserCreatedRequest $request)
    {
        $validated = $request->validated();
        
        $user = User::create($validated);

        return $this->createToken($user);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        
        $user = User::query()->where('email', $validated['email'])->first();

        if ($user == null || !$user->checkPassword($validated['password'])) {
            throw new UnauthorizedException("Your Credentials are wrong!");
        }
        
        return $this->createToken($user);
    }


    private function createToken(User $user)
    {
        $token = [
            'user_id' => $user->id,
            'expires_at' => now()->addDays(7)
        ];

        $tokenObject = [
            'token' => encrypt($token),
            'expires_at' => now()->addDays(7)
        ];

        return $tokenObject;
    } 
}
