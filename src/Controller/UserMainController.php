<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
final class UserMainController extends AbstractController
{
    #[Route(name: 'app_user_main')]
    public function index(): Response
    {
        return $this->render('user_main/index.html.twig', [
            'controller_name' => 'UserMainController',
        ]);
    }
}
