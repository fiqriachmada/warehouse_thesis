<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function user()
    {
        return view('components.auth.sign-in.user');
    }

    public function ghost()
    {
        return view('components.auth.sign-in.admin');
    }

    public function store(LoginRequest $request, $level)
    {
        $kredensial = $request->only('username', 'password');

        if ($level == 'admin') {
            $checkUser = User::where('username', $request->username)->where('level', $level)->first();
        } else {
            $checkUser = User::where('username', $request->username)->where('level', $level)->first();
        }

        if (empty($checkUser)) {
            return back()->withErrors([
                'username' => 'Wrong username or password!'
            ])->onlyInput('username');
        } else {
            if ($level == 'admin') {
                if ($checkUser->admin()->withTrashed()->first()->status == 'inactive' || $checkUser->admin()->withTrashed()->first()->deleted_at != null) {
                    return back()->withErrors([
                        'username' => 'Your account is inactive, please contact your administrator!'
                    ])->onlyInput('username');
                }
            } elseif ($level == 'tenant') {
                if ($checkUser->tenant()->withTrashed()->first()->status == 'inactive' || $checkUser->tenant()->withTrashed()->first()->deleted_at != null) {
                    return back()->withErrors([
                        'username' => 'Your account is inactive, please contact your administrator!'
                    ])->onlyInput('username');
                }
            }
        }

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user) {
                return redirect()->intended('/')->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Berhasil Masuk!'
                ]);
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Wrong username or password!'
        ])->onlyInput('username');
    }
}
