<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Src\Shared\Infrastructure\Exceptions\HandlerException;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Src\Shared\Infrastructure\Middleware\{ApiMiddleware,AuthMiddleware, RoleMiddleware};

use Src\Management\Login\Infrastructure\Services\RouteServiceProvider as LoginRouteServiceProvider;
use Src\Management\Login\Infrastructure\Services\DependencyServiceProvider as LoginDependencyServiceProvider;

use Src\Management\Forgot\Infrastructure\Services\RouteServiceProvider as ForgotRouteServiceProvider;
use Src\Management\Forgot\Infrastructure\Services\DependencyServiceProvider as ForgotDependencyServiceProvider;

use Src\Application\User\Infrastructure\Services\RouteServiceProvider as UserRouteServiceProvider;
use Src\Application\User\Infrastructure\Services\DependencyServiceProvider as UserDependencyServiceProvider;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'api.auth' => ApiMiddleware::class,
            'auth.jwt' => AuthMiddleware::class,
            'role.check' => RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

    })
    ->create();

$app->singleton(ExceptionHandler::class, HandlerException::class);


$app->register(LoginRouteServiceProvider::class);
$app->register(LoginDependencyServiceProvider::class);

$app->register(ForgotDependencyServiceProvider::class);
$app->register(ForgotRouteServiceProvider::class);

$app->register(UserRouteServiceProvider::class);
$app->register(UserDependencyServiceProvider::class);

return $app;
