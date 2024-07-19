<?php

namespace App\Views;

use Twig\Environment;

class View
{
    public function __construct(protected Environment $twig)
    {
    }

    public function exists(string $view): bool
    {
        return $this->twig->getLoader()->exists($view);
    }

    public function make(string $view, array $data = []): string
    {
        return $this->twig->render($view, $data);
    }


    public function render(string $twig, array $data = [])
    {
        return $this->twig->render($twig, $data);
    }
}
