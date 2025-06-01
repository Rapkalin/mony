<?php

namespace App\Controller;

use AllowDynamicProperties;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[AllowDynamicProperties] class HomeController extends BaseController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $user = $this->getUser();

        return $user ?
            $this->redirectToRoute('app_user') :
            $this->render('home/index.html.twig', $this->getData());
    }

    private function getData(): array
    {
        $data = [
            'var_example' => 'Var example',
            'email' => 'email'
        ];

        return $this->formatData($this->getControllerName(), $data);
    }
}
