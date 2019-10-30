<?php

namespace App\Http\Middleware;

use Closure;

class IsAnonymous
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
        if ($request->user() && $request->user()->status === 'admin') {
            return redirect('admin');
        } elseif ($request->user() && $request->user()->status === 'super-admin') {
            return redirect('super-admin');
        }

        return $next($request);
    }
}
