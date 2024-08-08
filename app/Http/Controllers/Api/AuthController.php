<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;

class AuthController extends Controller
{
    use ApiResponses;

    // Auth Check
    public function auth()
    {
        return response()->json([
            'auth' => auth('web')->check(),
            'user' => auth('web')->user()
        ]);
    }

    // Register User
    public function register()
    {
        // Registration Logic
    }

    // Login User
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {

            $request->session()->regenerate();

            return $this->success('Login Successful');
        }

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    // Logout User
    public function logout(Request $request)
    {
        Auth::guard("web")->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->success('You are now logged out');
    }
}
