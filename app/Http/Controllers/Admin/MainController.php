<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        return view('admin.index', compact('user'));
    }

    public function create(): View
    {
        $user = Auth::user();
        return view('admin.create', compact('user'));
    }
}
