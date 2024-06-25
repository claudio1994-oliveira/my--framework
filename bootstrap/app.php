<?php

use App\Core\App;

use App\Config\Config;
use App\Core\Container;
use App\Provider\ConfigServiceProvider;
use Laminas\Diactoros\Request;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\ReflectionContainer;
use League\Route\Router;

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

$app = new App();

$router = $container->get(Router::class);

$router->get('/', function () {
    var_dump("home");
    die();
});

$response = $router->dispatch($container->get(Request::class));


(new SapiEmitter())->emit($response);


$app->run();
