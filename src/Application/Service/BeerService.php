<?php
namespace App\Application\Service;

use Exception;
use App\Domain\Beer\Beer;
use App\Infrastructure\Api\PunkApi;
use Symfony\Contracts\Cache\CacheInterface;

class BeerService
{
    private $api;
    private $cache;


    public function __construct(PunkApi $api, CacheInterface $cache)
    {
        $this->api = $api;
        $this->cache = $cache;
    }

    public function getBeerById(int $id): Beer
    {
        return $this->cache->get('beer_' . $id, function ($item) use ($id) {

            $item->expiresAfter(3600);
            $beerData = $this->api->getBeerById($id);

            if (!$beerData) {
                return [];
            }
            $beer = $this->createBeerFromApiData($beerData);
            return $beer;
        });
    }

    public function searchBeersByFood(string $food)
    {
        $beerData = $this->api->searchBeersByFood($food);
        if (!$beerData) {
            return [];
        }
        $beers = $this->createBeerCollectionFromApiData($beerData);
        return $beers;
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

    private function createBeerCollectionFromApiData(array $beersData)
    {
        $beers = [];
        foreach ($beersData as $beerItem) {
            $beer = new Beer(
                $beerItem['id'],
                $beerItem['name'],
                $beerItem['tagline'],
                $beerItem['first_brewed'],
                $beerItem['description'],
                $beerItem['image_url']
            );
            $beers[] = $beer;
        }
        return $beers;
    }
}
