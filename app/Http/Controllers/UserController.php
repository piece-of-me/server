<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Api\User\StoreRequest;
use App\Http\Requests\Api\User\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        Auth::login($user);
        $token = Auth::user()->createToken('token');

        return response()->json([
            'error' => null,
            'result' => [
                'success' => true,
                'token' => $token->plainTextToken,
                'url' => route('admin.index'),
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

        $token = Auth::user()->createToken('token');
        return response()->json([
            'error' => null,
            'result' => [
                'success' => true,
                'token' => $token->plainTextToken,
                'url' => route('admin.index'),
            ],
        ]);
    }
}
