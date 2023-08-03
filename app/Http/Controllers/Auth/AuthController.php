<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        if ($user = Auth::user()) {
            if ($user->roles_id == 1) {
                return redirect()->intended('sarpras/dashboard');
            }
        }
        return view('auth.login', $data);
    }

    public function process(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required'    => "Email harus diisi!",
                'password.required' => "Password harus diisi!"
            ]
        );

        $kredensial = $request->only('email', 'password');

        $request->session()->regenerate();
        if (Auth::attempt($kredensial)) {
            $user = Auth::user();
            if ($user->role == 1) {
                return redirect()->intended('sarpras/dashboard');
            }
        }

        return redirect('login')->withErrors([
            'message'     => 'Tolong periksa Email atau Password!'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
