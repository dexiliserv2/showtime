<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserBookingController extends AbstractController
{
    #[Route('/user/booking', name: 'app_user_booking')]
    public function index(): Response
    {
        return $this->render('user_booking/index.html.twig', [
            'controller_name' => 'UserBookingController',
        ]);
    }
}
