<?php

namespace App\Controllers\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest as EmailVerificationFormRequest;

class EmailVerificationRequestController
{
    public function attempt(EmailVerificationFormRequest $request)
    {
        $request->fulfill();

        return redirect()->intended(default: route('app.index'))
            ->with('status', 'Email verified!');
    }
}
