<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Api\User\StoreRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(StoreRequest $request)
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
}
