<?php

namespace App\Provider;

use App\Config\Config;
use Laminas\Diactoros\ResponseFactory;
use Spatie\Ignition\Ignition;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Slim\Csrf\Guard;

class CsrfServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function register(): void
    {
        $this->getContainer()->add('csrf', function () {

            return new Guard(new ResponseFactory());
        })
            ->setShared(true);
    }

    public function boot(): void
    {
    }

    public function provides(string $id): bool
    {
        $services = [
            'csrf'
        ];

        return in_array($id, $services);
    }
}
