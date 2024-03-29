<?php

namespace App\Controllers\App;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class CookiesController
{
    public function __invoke(string $cookie)
    {
        switch ($cookie) {
            case 'desktopSidebarExpanded':
                Session::put('desktopSidebarExpanded', request()->json('open', true));
                break;
            case 'theme':
                Session::put('theme', $this->getThemeClassName(request()->json('theme', 'light')));
                break;

            default:
                break;
        }

        return new Response('', Response::HTTP_OK);
    }

    private function getThemeClassName(string $theme)
    {
        switch ($theme) {
            case 'light':
                return 'light';
            case 'dark':
                return 'dark';
            default:
                return 'light';
        }
    }
}
