<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LogUserActions;
use App\Http\Middleware\AlertMessages;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //

        $middleware->alias([
            'alert.messages' => AlertMessages::class,
            'log.user.actions' => LogUserActions::class
        ]);

//        $middleware->priority([
//            \App\Http\Middleware\LogUserActions::class, //记录用户操作 Alex
//        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
