<?php

namespace App\Http\Controllers;

use App\Config\Config;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function __construct(protected Config $config)
    {
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $response = new Response();


        $response->getBody()->write("<h1>Home</h1> ");
        $response->getBody()->write($this->config->get('app.name'));

        return $response;
    }
}