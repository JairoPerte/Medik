<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Middleware\AdminSessionMiddleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Middleware\CustomeLogoutMiddleware;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\RoutePath;
use Illuminate\Support\Facades\Session;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CheckAdminLogin::class);
        $this->app->singleton(CustomeLogoutMiddleware::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        if (Auth::guard('admin')->check()) {
            Log::info('Cambiando la sesión a la tabla de admin');
            Config::set('session.table', 'sessions_admin');
        }

        Route::post(RoutePath::for('logout', '/logout'), function (Request $request) {
            // Aquí simplemente se ejecutará el middleware automáticamente
            return redirect('/login');
        })->middleware([CustomeLogoutMiddleware::class, config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])->name('logout');


        //Para cambiar el pipeline de authenticateThrough
        Fortify::authenticateThrough(function (LoginRequest $request) {
            return array_filter([
                app(CheckAdminLogin::class), // Este es el middleware que cambiamos el guard
                config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
                AttemptToAuthenticate::class,
                PrepareAuthenticatedSession::class,
            ]);
        });


        // Configurar Rate Limiting para evitar ataques de fuerza bruta
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
