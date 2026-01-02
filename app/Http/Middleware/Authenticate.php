<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      
	    echo var_dump(\Auth::check());
    
    	
    	if (Auth::check()){
    		echo 'yes';
    	} else {
    		echo 'no';
    	}
    	

       
    }
}
