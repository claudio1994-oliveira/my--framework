<?php

use App\Core\App;

use App\Config\Config;
use App\Core\Container;
use App\Provider\ConfigServiceProvider;
use League\Container\ReflectionContainer;

require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(0);


$container = Container::getInstance();

$container->delegate(new ReflectionContainer());

$container->addServiceProvider(new ConfigServiceProvider());

$config = $container->get(Config::class);

foreach ($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider);
}

var_dump($container->get(Config::class)->get('app.name'));

die();

$app = new App();

$app->run();
