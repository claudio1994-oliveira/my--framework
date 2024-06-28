<?php

namespace App\Http\Controllers;


use App\Views\View;
use Laminas\Diactoros\Response;

use Psr\Http\Message\ServerRequestInterface;

class DashboardController
{
    public function __construct(protected View $view)
    {
    }

    public function __invoke(ServerRequestInterface $request)
    {

        $response = new Response();


        $response->getBody()->write(

            $this->view->render('dashboard.twig')

        );




        return $response;
    }
}
