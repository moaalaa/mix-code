<?php

namespace MixCode\Http\Middleware;

use Closure;

class Dashboard
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
        $user = auth()->user();

        if ( auth()->check() && ($user->isAdmin() || $user->isCompany()) ) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
