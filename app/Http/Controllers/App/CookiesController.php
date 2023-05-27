<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class CookiesController extends Controller
{
    public function __invoke(string $cookie)
    {
        switch ($cookie) {
            case 'desktopSidebarExpanded':
                Session::put('desktopSidebarExpanded', request()->json('open', true));
                break;

            default:
                break;
        }

        return new Response('', Response::HTTP_OK);
    }
}
