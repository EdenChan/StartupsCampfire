<?php

namespace StartupsCampfire\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RedirectIfAuthenticated
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!is_null(Auth::user('user'))) {
            return Redirect::route('frontend::posts.index');
        }

        return $next($request);
    }
}
