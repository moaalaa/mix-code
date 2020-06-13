<?php

namespace MixCode\Http\Middleware;

use Closure;

class AddCreatorIdToRequest
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
        $request->request->add(['creator_id' => auth()->id()]);
        return $next($request);
    }
}
