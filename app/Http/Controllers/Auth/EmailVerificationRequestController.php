<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest as EmailVerificationFormRequest;

class EmailVerificationRequestController extends Controller
{
    public function attempt(EmailVerificationFormRequest $request)
    {
        $request->fulfill();

        return redirect()->intended(default: route('app.index'))
            ->with('status', 'Email verified!');
    }
}
