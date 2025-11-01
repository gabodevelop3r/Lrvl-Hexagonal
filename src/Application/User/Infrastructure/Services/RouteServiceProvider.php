<?php

namespace Src\Application\User\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\RouteServiceProvider as BaseRouteServiceProvider;

final class RouteServiceProvider extends BaseRouteServiceProvider
{

    public function __construct($app)
    {
        $appVersion = env('APP_VERSION', 'v1');

        $this->setDependency(
            'api/'. $appVersion.'/user',
            'Src\Application\User\Infrastructure\Controllers',
            'Src/Application/User/Infrastructure/Routes/Api.php',
            ['api.auth', 'auth.jwt']
        );
        parent::__construct($app);
    }
}
