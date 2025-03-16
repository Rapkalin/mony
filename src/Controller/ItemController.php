<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ItemController extends BaseController
{
    #[Route('/addItem', name: 'app_item')]
    public function index(): Response
    {
        return $this->render('item/index.html.twig', $this->getData());
    }

    private function getData(): array
    {
        return $this->formatData($this->getControllerName(), [
            'username' => 'username',
            'sum' => $this->calculate(2)
        ]);
    }

    private function calculate(int $amount) : int
    {
        return $amount * $amount;
    }
}
