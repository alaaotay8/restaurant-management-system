<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Get the selected language from session
        $language = session( key: 'language' );

        //Set the current language

        app()->setLocale($language);

        // Log the updated locale for verification
        // Log :: info("Locale set to: ". $language . " (Selected language: ". $language .")");

        return $next($request);
    }
}
