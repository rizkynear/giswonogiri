<?php

namespace App\Http\Middleware;

use Closure;

class IsSuperAmin
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
        if ($request->user() && $request->user()->status !== 'super-admin') {
            return redirect('home');
        }

        return $next($request);
    }
}
