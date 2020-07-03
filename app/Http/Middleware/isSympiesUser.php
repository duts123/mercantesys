<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;

class isSympiesUser
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
        if ( session()->has('sympiesAccount')){
            return $next($request);
        }
        return 'Please Login as Sympies User';

    }
}
