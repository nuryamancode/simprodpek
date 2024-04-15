<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class LupaPasswordController extends Controller
{
    public function index()
    {
        return view('auths.lupa-password');
    }
    public function index2($token)
    {
        return view('auths.reset-password', ['token'=>$token]);
    }

    public function forget_password_send(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email'
            ],
            [
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Email harus berupa @'
            ]
        );

        $status = Password::sendResetLink(
            $request->only('email'),
        );

        return $status === Password::RESET_LINK_SENT ?
            back()->with('success', 'Reset password berhasil terkirim ke email') :
            back()->with('error', 'Terjadi kesalahan!');
    }


    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ],[
            'token.required'=>'Token wajib diisi',
            'email.reqiuired'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
            'password.min'=>'Password minimal 8 character',
            'password.confirmed'=>'Password harus sama'
        ]);

        $status = Password::reset(
            $request->only('email','password', 'password_confirmation','token'),
            function(User $user, string $password){
                $user->forceFill([
                    'password'=> Hash::make($password)
                ])->setRememberToken(str()::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('success', 'Reset password berhasil')
        : back()->with('error', 'Terjadi kesalahan!');
    }
}
