<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;

use Psr\Http\Message\ServerRequestInterface;

class DashboardController
{
    public function __construct(protected View $view, protected Sentinel $auth)
    {
    }

    public function __invoke(ServerRequestInterface $request)
    {


        $response = new Response();


        $response->getBody()->write(

            $this->view->render('dashboard.twig', ['users' => User::all()])

        );




        return $response;
    }
}
