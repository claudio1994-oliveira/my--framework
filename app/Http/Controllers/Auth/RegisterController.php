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

class RegisterController
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

            $this->view->render('auth/register.twig', [
                'errors' => $this->session->getFlashBag()->get('errors')[0] ?? null
            ])

        );

        return $response;
    }

    public function store(ServerRequestInterface $request)
    {

        try {
            v::key('first_name', v::alpha()->notEmpty())
                ->key('email', v::email()->notEmpty())
                ->key('password', v::notEmpty())
                ->assert($request->getParsedBody());
        } catch (ValidatorException $e) {
            $this->session->getFlashBag()->add('errors', $e->getMessages());

            return new RedirectResponse('/register');
        }

        if ($user = $this->auth->registerAndActivate($request->getParsedBody())) {
            $this->auth->login($user);
        }


        return new RedirectResponse('/dashboard');
    }
}
