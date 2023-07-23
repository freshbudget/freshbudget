<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function destroy(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
