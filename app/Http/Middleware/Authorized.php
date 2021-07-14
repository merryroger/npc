<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $fault = true;

        if ($request->session()->exists('user')) {
            $user = $request->session()->get('user');

            if (isset($user) && $user['bip']) {
                $fault = false;
            }
        }

        return ($fault) ? redirect()->route('guest.lvl1.sections') : $next($request);
    }
}
