<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class UserController extends BaseController
{
    #[Route('/user', name: 'app_user')]
    public function index(#[CurrentUser] User $user): Response
    {
        $expenses = [
            0 => [
                'title' => 'expense 1',
                'price' => '120 euros',
                'date' => '25/04/2025',
                'categories' => ['category 1', 'category 2']
            ],
            1 => [
                'title' => 'expense 2',
                'price' => '20 euros',
                'date' => '12/04/2025',
                'categories' => ['category 2', 'category 3']
            ],
            2 => [
                'title' => 'expense 3',
                'price' => '45 euros',
                'date' => '02/04/2025',
                'categories' => ['category 1']
            ]
        ];

        return $this->render('user/view.html.twig', [
            'user' => [
                'id' => $user->getId(),
                'name' => $user->getUsername(),
                'expenses' => $expenses
            ],
        ]);
    }
}
