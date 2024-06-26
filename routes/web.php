<?php

use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function (Router $router, ContainerInterface $container) {

    $router->get('/', function () {
        var_dump("home");
        die();
    });
};
