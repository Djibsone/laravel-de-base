<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login () {
        return view('auth.login');
    }

    public function doLogin (LoginRequest $request) {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('blog.index'));
        }

        return to_route('auth.login')->with(['message' => ['type' => 'danger', 'text' => 'Email ou mot de passe incorrect.']])->onlyInput('email');
    }

    public function register () {
        return view('auth.register');
    }

    public function doRegister (RegisterRequest $request) {
        User::create($request->validated());

        return to_route('auth.register')->with(['message' => ['type' => 'success', 'text' => 'L\'utilisateur a été bien crée.']])->onlyInput(['name', 'email']);
    }

    public function logout () {
        Auth::logout();

        return to_route('auth.login')/*->with(['message' => ['type' => 'success', 'text' => 'Vous êtes déconnectés.']])*/;
    }
}
