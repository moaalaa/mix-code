<?php

namespace MixCode\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ForceHttps
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
        if (! $request->secure() && app()->environment('production')) {
            return redirect()->secure($request->getRequestUri(), Response::HTTP_MOVED_PERMANENTLY);
        }

        return $next($request);
    }
}
