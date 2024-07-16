<?php

namespace App\Http\Controllers\Auth;



use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class LogoutController
{
    public function __construct(protected Sentinel $auth, protected Session $session)
    {
    }



    public function __invoke(ServerRequestInterface $request)
    {
        $this->auth->logout($this->auth->getUser());

        $this->session->getFlashBag()->add('message', 'You have been logged out.');

        return new RedirectResponse('/');
    }
}
