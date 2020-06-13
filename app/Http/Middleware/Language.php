<?php

namespace MixCode\Http\Middleware;

use Closure;

use MixCode\MultiLanguageManager;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        app()->setLocale(MultiLanguageManager::getLanguage());

        return $next($request);
    }
}
