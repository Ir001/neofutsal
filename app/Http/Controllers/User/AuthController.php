<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Exception;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('user.auth.login');
    }

    /**
     * REST Login
     *
     * @return json
     */
    public function authLogin()
    {
        $request = new LoginRequest();
        $validator = Validator::make(request()->all, $request->rules, $request->messages());
        if ($validator->fails()) {
            $errors = Helpers::setErrors($validator->errors()->messages());
            return response()->json(['success' => false, 'error' => true, 'message' => $errors]);
        }
        try {
            $validated = $validator->validated();
            $remember_me = (@$validated['remember_me'] ? true : false);
            if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password'], 'remember_me' => $remember_me])) {
                return response()->json(['success' => true, 'message' => 'Login berhasil!']);
            }
            return response()->json(['success' => false, 'message' => 'Email atau password salah!']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function register()
    {
        return view('user.auth.register');
    }

    public function authRegister()
    {
    }
}
