<?php

namespace Src\Management\Forgot\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends  ServiceProvider
{

    public function __construct($app)
    {
        $appVersion = env('APP_VERSION', 'v1');
        $this->setDependency(
            'api/'. $appVersion.'/forgot',
            'Src\Management\Forgot\Infrastructure\Controllers',
            'Src/Management/Forgot/Infrastructure/Routes/Api.php',
            ['api.auth']
        );
        parent::__construct($app);
    }

}
