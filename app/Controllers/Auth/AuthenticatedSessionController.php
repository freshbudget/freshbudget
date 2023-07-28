<?php

namespace App\Controllers\Auth;

use Illuminate\Http\Request;

class AuthenticatedSessionController
{
    public function destroy(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
