<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (auth()->check()){

            if (auth()->user()->isAdmin()){

                return $next($request);

            }
        }

        return redirect('/');
    }


    public function handle1($request, Closure $next, $role, $permission = null){
      
      if(!$request->user()->hasRole($role)) {
         abort(404);
      }
      
      if($permission !== null && !$request->user()->can($permission)) {
          abort(404);
      }
      
      return $next($request);
      
    }
}