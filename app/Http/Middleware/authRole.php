<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class authRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
//cek role user yang telah login
        if ($role == 'admin') {
            if(Auth::check() && Auth::user()->isAdmin()) {
                return $next($request);
            }else{
                return redirect('home');
            }
        }else if($role == 'member'){
            if (Auth::check()) {
                return $next($request);
            }else{
                return redirect('home');
            }
            //apabila role tidak ada/ tidak memenuhi maka di return ke home
        }else if($role == null){
            return $next($request);
        }else{
            return redirect('home');
        }
    }
}
