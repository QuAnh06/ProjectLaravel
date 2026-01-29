<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\SetLocale;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // $middleware -> alias([                 // Đki qua alias dùng trong route cần
        //     'admin' => AuthMiddleware::class,
        //     'check.age' => EnsureAgeIsValid::class,
        // ]);

        // $middleware -> append(MyLastCheck::class)         // Đki Global

        $middleware -> alias([
            'auth' => Authenticate::class,
            'admin' => AdminMiddleware::class,
            'prevent' => PreventBackHistory::class
        ]);
        
        $middleware->web(append: [
            SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
