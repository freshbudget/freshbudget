<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest as EmailVerificationFormRequest;
use Illuminate\Http\Request;

class EmailVerificationRequestController extends Controller
{
    public function attempt(EmailVerificationFormRequest $request)
    {
        $request->fulfill();

        return redirect()->route('welcome')
            ->with('message', 'Email verified!');
    }

    public function create(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back(fallback: route('verification.notice'))
            ->with('message', 'Verification link sent!');
    }

    public function show()
    {
        return view('auth.verify-email');
    }
}
