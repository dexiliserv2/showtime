<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AllFestivalsController extends AbstractController
{
    #[Route('/all/festivals', name: 'app_all_festivals')]
    public function index(): Response
    {
        return $this->render('all_festivals/index.html.twig', [
            'controller_name' => 'AllFestivalsController',
        ]);
    }
}
