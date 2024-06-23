<?php

namespace App\Provider;

use Spatie\Ignition\Ignition;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function register(): void
    {
    }

    public function boot(): void
    {
        Ignition::make()->register();
    }

    public function provides(string $id): bool
    {
        $services = [
            'App\Core\App'
        ];

        return in_array($id, $services);
    }
}
