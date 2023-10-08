<?php

namespace App\Presentation\Controller;

use App\Domain\Beer\Beer;
use App\Application\Service\BeerService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BeerController extends AbstractController
{
    private $beerService;

    public function __construct(BeerService $beerService)
    {
        $this->beerService = $beerService;
    }

    #[Route('/findbyid/beer/{id}', name: 'find_beer_by_id', requirements: ['id' => '\d+'])]
    public function getBeerById(int $id): JsonResponse
    {
        try {
            $beer = $this->beerService->getBeerById($id);

            if (!$beer) {
                return new JsonResponse(['message' => 'No beer found with the provided ID.'], 404);
            }

            return new JsonResponse($beer->toArray());
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    #[Route('/findbyfood/beer/{food}', name: 'find_beer_by_food')]
    public function searchBeersByFood(string $food): JsonResponse
    {
        if (!$food) {
            return new JsonResponse(['error' => 'You must provide a "food" parameter for the search.'], 400);
        }

        try {
            $matchingBeers = $this->beerService->getBeersByFood($food);

            if (!$matchingBeers) {
                return new JsonResponse(['message' => 'No results found. Drink water, my friend.'], 200);
            }

            $jsonData = Beer::toArrayCollection($matchingBeers);

            return new JsonResponse($jsonData);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    private function handleError(\Exception $e): JsonResponse
    {
        return new JsonResponse(['error' => $e->getMessage(), 'code' => $e->getCode()], 500);
    }
}
