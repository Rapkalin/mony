<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ItemController extends AbstractController
{
    #[Route('/addItem', name: 'app_item')]
    public function index(): Response
    {
        $result = $this->calculate(2);
        return $this->render('item/index.html.twig', [
            'controller_name' => 'ItemController',
            'sum' => $result
        ]);
    }

    public function calculate(int $amount) : int
    {
        return $amount * $amount;
    }

}
