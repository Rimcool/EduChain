<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware; // Don't forget to import your middleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register your custom middleware with an alias
        $middleware->alias([
            'role'     => \App\Http\Middleware\CheckRole::class,
            'approved' => \App\Http\Middleware\CheckApproved::class,
            'api.key'  => \App\Http\Middleware\CheckApiKey::class,
        ]);

        // You can also append global middleware here if needed
        // $middleware->append(AnotherGlobalMiddleware::class);

        // Or add to specific groups (e.g., 'web' group)
        // $middleware->web(append: [
        //     AnotherWebMiddleware::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();