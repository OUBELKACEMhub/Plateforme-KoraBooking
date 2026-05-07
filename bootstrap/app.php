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
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 1. Hado les Aliases li kano 3ndek (Khllinahom kima homa)
        $middleware->alias([
            'manager' => \App\Http\Middleware\IsManager::class,
            'customer' => \App\Http\Middleware\IsCustomer::class,
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

       
        $middleware->web(append: [
            \App\Http\Middleware\CheckBannedUser::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();