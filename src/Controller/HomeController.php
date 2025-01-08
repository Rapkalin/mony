<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $result = $this->calcul(2);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'sum' => $result
        ]);
    }

    public function calcul(int $int): int
    {
        return $int*2;
    }
}
