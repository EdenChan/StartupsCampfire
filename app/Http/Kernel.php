<?php

namespace StartupsCampfire\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \StartupsCampfire\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \StartupsCampfire\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'        => \StartupsCampfire\Http\Middleware\Authenticate::class,
        'auth.basic'  => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest'       => \StartupsCampfire\Http\Middleware\RedirectIfAuthenticated::class,
        'admin'       => \StartupsCampfire\Http\Middleware\AdminAuthenticate::class,
        'admin.guest' => \StartupsCampfire\Http\Middleware\AdminGuest::class
    ];
}
