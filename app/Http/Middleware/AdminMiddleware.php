<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
//      if(auth()->guest())
//      {
//        return redirect()->guest('/login');
//      }

      if(auth()->check() && $request->user()->admin==0)
      {
        return redirect()->guest('/');
      }

      return $next($request);
    }
}
