<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'cpf' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'cpf' => 'CPF ou senha inválidos.',
            ])->onlyInput('cpf');
        }

        $request->session()->regenerate();

        $user = $request->user();

        if ($user->is_admin) {
            return redirect()->route('admin.reports');
        }

        return redirect()->route('survey.show', ['audience' => $user->audience->value]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
