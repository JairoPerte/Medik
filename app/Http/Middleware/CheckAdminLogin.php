<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\App;
use \Laravel\Fortify\Actions\AttemptToAuthenticate;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $emailField = Fortify::username(); // El campo de email
        $email = $request->input($emailField);

        // Si el correo comienza con "admin-", cambiar el guard a 'admin' y limpiar el email
        if (str_starts_with($email, 'admin-')) {
            // Cambiar el guard a 'admin'
            Auth::shouldUse('admin');

            // Quitar "admin-" del inicio del email
            $cleanEmail = substr($email, 6);
            $request->merge([$emailField => $cleanEmail]);

            //FORZAMOS A QUE UTILIZE EL GUARD ADMIN PQ NO LE DA LA GANA SINO
            App::extend(AttemptToAuthenticate::class, function ($service, $app) {
                return new AttemptToAuthenticate(Auth::guard('admin'), $app->make(\Laravel\Fortify\LoginRateLimiter::class));
            });

            $request->attributes->set('is_admin', true);

            // Log para verificar que el email ha sido modificado correctamente
            Log::info("Guard cambiado a 'admin'. Nuevo email: $cleanEmail");
        } else {
            Auth::shouldUse('web');

            App::extend(AttemptToAuthenticate::class, function ($service, $app) {
                return new AttemptToAuthenticate(Auth::guard('web'), $app->make(\Laravel\Fortify\LoginRateLimiter::class));
            });
        }

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            Log::info('Se ha iniciado sesión si se usa admin');
        }

        return $next($request);
    }
}
