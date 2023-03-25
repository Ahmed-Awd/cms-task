<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (Auth::attempt(['username' => $data['username'], 'password' => $data['password']])) {
            $user = User::where('username', $data['username'])->first();
            if (!$user->hasRole($data["role"])) {
                return response()->json(['message' => Lang::get('messages.auth.invalid')], 401);
            }
            $token = $user->createToken('auth_token', ['*'], $data['notification_token'] ?? null)->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        }
        return response()->json(['message' => Lang::get('messages.auth.invalid')], 401);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();
        if (Hash::check($data['old_password'], $user->password)) {
            $user->update([
                "password" => $data['password'],
            ]);
            return response()->json(['message' => Lang::get('messages.auth.password_changed')]);
        }
        return response()->json(['message' => Lang::get('messages.auth.invalid_old_password')], 403);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => Lang::get('messages.auth.logout')]);
    }
}
