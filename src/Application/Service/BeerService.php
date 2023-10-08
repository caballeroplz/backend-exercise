<?php
namespace App\Application\Service;

use Exception;
use App\Domain\Beer\Beer;
use App\Infrastructure\Api\PunkApi;

class BeerService
{
    private $api;

    public function __construct(PunkApi $api)
    {
        $this->api = $api;
    }

    public function getBeerById(int $id)
    {
        $beerData = $this->api->getBeerById($id);
        if (!$beerData) {
            throw new Exception('No found beer with id: '. $id, 100);
        }
        $beer = $this->createBeerFromApiData($beerData);
        return $beer;
    }

    private function createBeerFromApiData(array $beerData)
    {
        $beer = new Beer(
            $beerData['id'],
            $beerData['name'],
            $beerData['tagline'],
            $beerData['first_brewed'],
            $beerData['description'],
            $beerData['image_url']
        );
        return $beer;
    }
}
