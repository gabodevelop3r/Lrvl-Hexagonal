<?php

namespace Src\Management\Login\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends  ServiceProvider
{

    public function __construct($app)
    {
        $appVersion = env('APP_VERSION', 'v1');
        $this->setDependency(
            'api/'. $appVersion.'/login',
            'Src\Management\Login\Infrastructure\Controllers',
            'Src/Management/Login/Infrastructure/Routes/Api.php',
            ['api.auth']
        );
        parent::__construct($app);
    }

}
