<?php

namespace App\Http\Controllers\Auth;



use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;

class LogoutController
{
    public function __construct(protected Sentinel $auth)
    {
    }



    public function __invoke(ServerRequestInterface $request)
    {
        $this->auth->logout($this->auth->getUser());

        return new RedirectResponse('/login');
    }
}
