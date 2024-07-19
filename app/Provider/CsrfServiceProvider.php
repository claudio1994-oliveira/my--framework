<?php

namespace App\Provider;

use Slim\Csrf\Guard;
use App\Config\Config;
use Spatie\Ignition\Ignition;
use Laminas\Diactoros\ResponseFactory;
use App\Validation\Exceptions\CsrfTokenException;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class CsrfServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function register(): void
    {
        $this->getContainer()->add('csrf', function () {

            $guard = new Guard(new ResponseFactory());

            $guard->setFailureHandler(function () {
                throw new CsrfTokenException();
            });

            return $guard;
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
