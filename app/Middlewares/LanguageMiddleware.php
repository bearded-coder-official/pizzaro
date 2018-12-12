<?php

namespace App\Middlewares;

use Illuminate\Http\Request;

class LanguageMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        if($lang = $request->route()->parameter('lang')) {
            \Illuminate\Support\Facades\App::setLocale($lang);
        }

        return $next($request);
    }
}