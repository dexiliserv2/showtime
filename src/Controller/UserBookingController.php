<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Repository\FestivalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/user/booking')]
final class UserBookingController extends AbstractController
{
    public function __construct(
        private BookingRepository  $bookingRepository,
        private FestivalRepository $festivalRepository,
    )
    {
    }

    #[Route(name: 'app_festival_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        $locations = $this->festivalRepository->findAllUniqueLocations();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($booking);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_main', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_booking/index.html.twig', [
            'booking' => $booking,
            'form' => $form,
            'locations' => $locations,
        ]);
    }
}
