<?php

namespace App\Http\Controllers\Auth;


use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\Session\Session;
use Respect\Validation\Validator as v;

class LoginController
{
    public function __construct(
        protected View $view,
        protected Sentinel $auth,
        protected Session $session
    ) {
    }

    public function index(ServerRequestInterface $request)
    {

        $response = new Response();


        $response->getBody()->write(

            $this->view->render(
                'auth/login.twig',
                [
                    'errors' => $this->session->getFlashBag()->get('errors')[0] ?? null
                ]
            )

        );

        return $response;
    }

    public function store(ServerRequestInterface $request)
    {
        try {
            v::key('email', v::email()->notEmpty())
                ->key('password', v::notEmpty())
                ->assert($request->getParsedBody());
        } catch (ValidatorException $e) {
            $this->session->getFlashBag()->add('errors', $e->getMessages());

            return new RedirectResponse('/login');
        }


        if (!$this->auth->authenticate($request->getParsedBody())) {
            $this->session->getFlashBag()->add('errors', [
                'email' => 'Could not log you in whit those details.'
            ]);

            return new RedirectResponse('/login');
        }

        return new RedirectResponse('/dashboard');
    }
}
