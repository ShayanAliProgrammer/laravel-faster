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
        $middleware->web([
            \Fahlisaputra\Minify\Middleware\MinifyCss::class,
            // Middleware to minify Javascript
            \Fahlisaputra\Minify\Middleware\MinifyJavascript::class,
            // Middleware to minify Blade
            \Fahlisaputra\Minify\Middleware\MinifyHtml::class,
        ]);

        $middleware->alias([
            'route_caching' => App\Http\Middleware\RouteCaching::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
