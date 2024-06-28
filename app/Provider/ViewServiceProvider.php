<?php

namespace App\Provider;

use App\Views\View;
use Twig\Environment;
use App\Config\Config;
use App\Views\TwigExtension;
use App\Views\TwigRuntimeLoader;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;
use App\Views\TwigRuntimeExtension;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class ViewServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function register(): void
    {
        $this->getContainer()->add(View::class, function () {
            $loader = new FilesystemLoader(__DIR__ . '/../../resources/views');

            $debug = $this->getContainer()->get(Config::class)->get('app.debug');

            $twig = new Environment(
                $loader,
                [
                    'cache' => false,
                    'debug' => $debug,
                ]
            );

            $twig->addRuntimeLoader(new TwigRuntimeLoader($this->getContainer()));

            $twig->addExtension(new TwigExtension());
            $twig->addExtension(new DebugExtension());

            return new View($twig);
        });
    }

    public function boot(): void
    {
    }

    public function provides(string $id): bool
    {
        $services = [
            View::class
        ];

        return in_array($id, $services);
    }
}
