<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Views\View;
use Laminas\Diactoros\Response;

use Psr\Http\Message\ServerRequestInterface;

class UserController
{
    public function __construct(protected View $view)
    {
    }

    public function __invoke(ServerRequestInterface $request, array $arguments)
    {

        ['user' => $userId] = $arguments;

        $user = User::find($userId);

        return view('user.twig', ['user' => $user]);
    }
}
