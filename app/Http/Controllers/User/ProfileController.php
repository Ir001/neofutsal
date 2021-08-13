<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.profile.index', compact('user'));
    }
    public function edit()
    {
        $user = auth()->user();
        return view('user.profile.edit', compact('user'));
    }
}
