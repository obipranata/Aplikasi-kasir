<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class cekKasir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if($user){
            if($user->level == 2){
                return $next($request);
            }else{
                return abort(404);
            }
        }else{
            return redirect('/login');
        }
    }
}
