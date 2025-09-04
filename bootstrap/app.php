<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;
use App\Http\Middleware\IsAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ✅ alias middlewares
        $middleware->alias([
            'auth' => \App\Http\Controllers\Auth\AuthenticatedSessionController::class,
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'is_admin' => IsAdmin::class,
        ]);

        // ✅ CORS activé sur toutes les routes API
        $middleware->api(prepend: [
            HandleCors::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();

    $app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
    );

    // Middleware global
    $app->middleware([
        \App\Http\Middleware\CorsMiddleware::class,
    ]);

    return $app;
