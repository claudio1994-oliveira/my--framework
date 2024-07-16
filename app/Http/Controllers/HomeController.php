<?php

namespace App\Http\Controllers;

use App\Views\View;
use App\Config\Config;
use Laminas\Diactoros\Response;

use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController
{
    public function __construct(protected Config $config, protected View $view, protected Session $session)
    {
    }

    public function __invoke(ServerRequestInterface $request)
    {

        $response = new Response();


        $response->getBody()->write(

            $this->view->render('home.twig', [
                'name' => 'No Framework',
                'message' => $this->session->getFlashBag()->get('message')
            ])

        );




        return $response;
    }
}
