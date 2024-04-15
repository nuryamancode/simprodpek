<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerifikasiController extends Controller
{
    function index()
    {

        return view('auths.verifikasi-email');
    }

    function handler_verification(EmailVerificationRequest $emailVerificationRequest)
    {
        $emailVerificationRequest->fulfill();
        alert()->toast('Email berhasil diverifikasi', 'success');
        return redirect('/login')->with('success', 'Email berhasil diverifikasi');
    }

    public function resend_email(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        alert()->toast('Verifikasi berhasil dikirim', 'success');
        return redirect()->back();
    }
}
