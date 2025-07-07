<?php

namespace App\Controller;

use App\Repository\FestivalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FestivalAjaxController extends AbstractController
{
    public function __construct(
        private FestivalRepository $festivalRepository
    )
    {
    }

    #[Route('/api/festivals-by-location', name: 'api_festivals_by_location', methods: ['GET'])]
    public function getFestivalsByLocation(Request $request): JsonResponse
    {
        $locationName = $request->query->get('location'); // Get 'location' parameter from query string

        if (!$locationName) {
            return new JsonResponse(['error' => 'Location parameter missing'], Response::HTTP_BAD_REQUEST);
        }

        // Use your existing repository method, or create a new one to filter by location
        // Make sure this method returns Festival objects with their IDs and names.
        // We'll use findUpcomingByLocation here.
        $festivals = $this->festivalRepository->findUpcomingByLocation($locationName);

        $festivalData = [];
        foreach ($festivals as $festival) {
            $festivalData[] = [
                'id' => $festival->getId(),
                'name' => $festival->getName(),
                'startDate' => $festival->getStartDate()->format('M d, Y'), // Format date for display
            ];
        }

        return new JsonResponse($festivalData); // Return JSON response
    }
}
