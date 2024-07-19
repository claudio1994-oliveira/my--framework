<?php

namespace App\Exceptions;

use App\Views\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class ExceptionHandler
{
    public function __construct(protected View $view)
    {
    }

    public function handle(ServerRequestInterface $request, ResponseInterface $response, Throwable $exception)
    {

        if ($view = $this->getErrorView($exception)) {
            $response->getBody()->write($view);
            return $response;
        }

        throw $exception;
    }

    protected function getErrorView(Throwable $exception)
    {
        if (!method_exists($exception, 'getStatusCode')) {
            return null;
        }

        $view = 'errors/' . $exception->getStatusCode() . '.twig';



        if (!$this->view->exists($view)) {
            return null;
        }

        return $this->view->render($view, ['exception' => $exception]);
    }
}
