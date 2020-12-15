<?php

namespace App\Http\Middleware;

use App\Http\Controllers\NotificationTrait;
use Closure;

class AuthorizationMiddleware
{
    use NotificationTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth('web')->user()->role === 'admin')
            return $next($request);
        else{
            self::NotAuthorized();
            return redirect()->route('dashboard');
        }

    }
}
