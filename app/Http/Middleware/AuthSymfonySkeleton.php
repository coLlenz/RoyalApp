<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSymfonySkeleton {
	public function handle(Request $request, Closure $next)
    {
        if(session()->get('user_data')){
			return $next($request);
		}
		
		return redirect()->route('auth.login');
    }
}