<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LogoutResponse;

class CustomeLogoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Logout both web and admin guards
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();

        // Invalidate and regenerate the session
        Session::invalidate();
        Session::regenerateToken();

        // Forget the session cookies
        $cookie = cookie()->forget(config('session.cookie'));
        $csrfCookie = cookie()->forget('XSRF-TOKEN');

        // Continue with the request and append the cookies
        $response = $next($request);

        // Attach the cookies to the response
        $response->headers->setCookie($cookie);
        $response->headers->setCookie($csrfCookie);

        // Return the response with the cookies
        return $response;
    }
}
