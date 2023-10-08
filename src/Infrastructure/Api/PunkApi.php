<?php

namespace App\Infrastructure\Api;

use Exception;
use GuzzleHttp\Client;

class PunkApi
{
    private const BASE_URL = 'https://api.punkapi.com/v2/';
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function getBeerById(int $id): ?array
    {
        $url = self::BASE_URL . 'beers/' . $id;

        try {
            $response = $this->httpClient->get($url);
            $data = json_decode($response->getBody(), true);
            return $data[0] ?? null;
        } catch (Exception $e) {
            throw new Exception('Error fetching beer from the Punk API.', 10);
        }
    }

}
