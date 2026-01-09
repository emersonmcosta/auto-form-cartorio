<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class userAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {



        if (!Auth::user()) {
            return redirect('login');
        }

        $routesIgnored = [
            'login'
        ];

        $path = $request->path();
        $segments = explode('/', $path);
        $firstTwo = array_slice($segments, 0, 2);
        $twoLevelPath = implode('/', $firstTwo);

        if (!in_array($twoLevelPath, $routesIgnored)) {
            return redirect()->back();
        }
        return $next($request);
    }
}
