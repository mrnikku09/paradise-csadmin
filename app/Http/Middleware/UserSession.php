<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Route;
class UserSession
{
    public function handle(Request $request, Closure $next)
    {
	    if (!$request->session()->exists('CS_USER'))
        {
            return redirect()->route('website.index');// here you should redirect to login 
        }
        return $next($request);
    }
}