<?php

namespace App\Http\Controllers;

use App\Views\View;
use App\Config\Config;
use App\Models\User;
use Laminas\Diactoros\Response;

use Psr\Http\Message\ServerRequestInterface;


class HomeController
{
    public function __construct(protected Config $config, protected View $view)
    {
    }

    public function __invoke(ServerRequestInterface $request)
    {

        return view('home.twig', [
            'name' => 'No Framework',
            'users' => User::paginate(1)
        ]);
    }
}
