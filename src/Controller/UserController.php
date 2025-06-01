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
        return $this->render('user/view.html.twig', [
            'user' => $user->getUserData(),
        ]);
    }
}