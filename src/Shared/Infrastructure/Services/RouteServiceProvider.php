<?php

namespace Src\Shared\Infrastructure\Services;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

abstract class RouteServiceProvider extends ServiceProvider
{
    protected mixed $prefix, $group;
    protected $namespace;
    protected array $middlewareGroup;

    public function setDependency (mixed $prefix, mixed $namespace, mixed $group, array $middlewareGroup = ['api.auth', 'auth.jwt'] )
    {
        $this->prefix = $prefix;
        $this->namespace = $namespace;
        $this->group = $group;
        $this->middlewareGroup = $middlewareGroup;

    }

    public function boot():void
    {
        parent::boot();
    }

    public function map(): void
    {
        $this->mapRoutes();
    }

    public function mapRoutes(): void
    {

        Route::middleware($this->middlewareGroup)->prefix($this->prefix)
                ->namespace($this->namespace)
                ->group(base_path($this->group));
    }





}
