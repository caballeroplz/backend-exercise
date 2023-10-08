<?php

namespace App\Presentation\Controller;

use App\Application\Service\BeerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BeerController extends AbstractController
{
    private $beerService;

    public function __construct(BeerService $beerService)
    {
        $this->beerService = $beerService;
    }

    #[Route('/findbyid/beer/{id}', name: 'find_beer_by_id')]
    public function getBeerById(int $id): JsonResponse
    {
        try {
            $beer = $this->beerService->getBeerById($id);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage(), 'code' => $e->getCode()], 500);
        }
        return new JsonResponse($beer->toArray());
    }

}
