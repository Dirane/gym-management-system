<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', config('app.locale', 'en'));
        
        // Validate locale exists in supported locales
        $supportedLocales = ['en', 'fr'];
        
        if (in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
        }
        
        return $next($request);
    }
} 