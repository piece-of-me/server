<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Http\Requests\Api\User\StoreRequest;
use App\Http\Requests\Api\User\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function me(): JsonResponse
    {
        return response()->json([
            'error' => null,
            'result' => new UserResource(Auth::user()),
        ]);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        Auth::login($user);
        $token = Auth::user()->createToken('token');

        $key = md5($user->login);
        Cache::put($key, $user->login, 30);
        return response()->json([
            'error' => null,
            'result' => [
                'success' => true,
                'token' => $token->plainTextToken,
                'url' => route('auth.redirect', ['key' => $key]),
            ],
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (!Auth::attempt($data)) {
            return response()->json([
                'error' => null,
                'result' => [
                    'success' => false,
                    'message' => 'Указаны неверные логин/пароль',
                ],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('token');
        $key = md5($user->login);
        Cache::put($key, $user->login, 30);
        return response()->json([
            'error' => null,
            'result' => [
                'success' => true,
                'token' => $token->plainTextToken,
                'url' => route('auth.redirect', ['key' => $key]),
            ],
        ]);
    }
}
