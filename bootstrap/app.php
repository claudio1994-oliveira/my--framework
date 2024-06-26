<?php

use App\Core\App;

use App\Config\Config;
use App\Core\Container;
use App\Provider\ConfigServiceProvider;
use Laminas\Diactoros\Request;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\ReflectionContainer;
use League\Route\Router;
use Psr\Container\ContainerInterface;

error_reporting(0);

require_once __DIR__ . '/../vendor/autoload.php';


$dotEnv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotEnv->load();

$container = Container::getInstance();

$container->delegate(new ReflectionContainer());

$container->addServiceProvider(new ConfigServiceProvider());

$config = $container->get(Config::class);

foreach ($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider);
}

$app = new App($container);

(require('../routes/web.php'))($app->getRouter(), $container);




$app->run();
