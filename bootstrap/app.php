<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        /**
         * Here I add this code for register the new file called admin.php
         * this is for admin route's and separate the routes for normal user and admin
         */

        then: function(){
            Route::middleware('web', 'auth', 'role:admin')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        // I add this line of code for create a middleware alias instead use kernel.php form laravel 10 or
        // RoterServicesProviders.php
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
