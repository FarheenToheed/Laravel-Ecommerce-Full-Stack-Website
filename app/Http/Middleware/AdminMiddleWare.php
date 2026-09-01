<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if(!$user){
            return redirect()->route('home')->with('error','you need to login to access this website');
        }
        if($user->role !== 'admin'){
            return redirect()->route('home')->with('error','you need to login as admin to access this page');
        }
        return $next($request);
    }
}
