<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        'locale' => \App\Http\Middleware\SetLocale::class,
    ]);
    $middleware->web([
        // bu yerda 'locale' middleware'ni `StartSession` dan keyin joylashtirish kerak
        \Illuminate\Session\Middleware\StartSession::class,
        \App\Http\Middleware\SetLocale::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
