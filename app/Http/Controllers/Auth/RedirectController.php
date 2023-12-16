<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class RedirectController extends Controller
{
    public function __invoke(string $key): \Illuminate\Http\RedirectResponse
    {
        $login = Cache::get($key);
        Cache::forget($key);
        if (!isset($login)) {
            return redirect()->route('login.index');
        }
        $user = User::firstWhere('login', $login);
        Auth::login($user);
        return redirect()->route('admin.index');
    }
}
