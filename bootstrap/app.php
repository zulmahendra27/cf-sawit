<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsPimpinan;
use App\Http\Middleware\IsUser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/login');
        $middleware->alias([
            'admin' => IsAdmin::class,
            'user' => IsUser::class,
            'pimpinan' => IsPimpinan::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
