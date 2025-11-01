<?php

namespace Src\Shared\Infrastructure\Services;

use Illuminate\Support\ServiceProvider as Service;

class DependencyServiceProvider extends Service
{
    private array $dependencies;
    public function setDependency(array $dependencies) : void
    {
        $this->dependencies = $dependencies;
    }

    public function register(): void
    {
        foreach ($this->dependencies as $implementation) {
            $this->app
                ->when($implementation['useCase'])
                ->needs($implementation['contract'])
                ->give($implementation['repository']);
        }
    }


}
