<?php

namespace App\Http\Controllers\Auth;


use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;

class LoginController
{
    public function __construct(protected View $view, protected Sentinel $auth)
    {
    }

    public function index(ServerRequestInterface $request)
    {

        $response = new Response();


        $response->getBody()->write(

            $this->view->render('auth/login.twig')

        );

        return $response;
    }

    public function store(ServerRequestInterface $request)
    {
        if (!$this->auth->authenticate($request->getParsedBody())) {
            return new RedirectResponse('/login');
        }

        return new RedirectResponse('/dashboard');
    }
}
