<?php

namespace App\Controller;

use AllowDynamicProperties;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[AllowDynamicProperties] class HomeController extends BaseController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', $this->getData());
    }

    private function getData(): array
    {
        return $this->formatData($this->getControllerName(), [
            'var_example' => 'Var example',
            'email' => 'email'
        ]);
    }
}
