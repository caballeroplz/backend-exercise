<?php

namespace App\Service;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Service for caching API responses.
 *
 * @package App\Service
 */
class ApiCacheService
{
    private $cache;
    private $cacheDurationInSeconds;

    /**
     * ApiCacheService constructor.
     *
     * @param AdapterInterface $cache                The cache adapter.
     * @param int              $cacheDurationInSeconds The duration in seconds to cache the API response (optional).
     */
    public function __construct(AdapterInterface $cache, int $cacheDurationInSeconds = 3600)
    {
        $this->cache = $cache;
        $this->cacheDurationInSeconds = $cacheDurationInSeconds;
    }

    /**
     * Get an API response with caching.
     *
     * @param string $apiUrl   The URL of the API to request.
     * @param string $cacheKey The cache key to use for storing and retrieving the response.
     *
     * @return array The API response data.
     * @throws \Exception If there's an error while fetching data from the API.
     */
    public function getApiResponseWithCache(string $apiUrl, string $cacheKey): array
    {
        // Attempt to retrieve data from the cache
        $cacheItem = $this->cache->getItem($cacheKey);

        if (!$cacheItem->isHit()) {
            // If not in cache, make the API request
            $httpClient = HttpClient::create();
            $response = $httpClient->request('GET', $apiUrl);

            if ($response->getStatusCode() === 200) {
                $data = $response->toArray();

                // Cache the data
                $cacheItem->set($data);
                $cacheItem->expiresAfter($this->cacheDurationInSeconds);
                $this->cache->save($cacheItem);
            } else {
                throw new \Exception('Error fetching data from the API');
            }
        } else {
            // If in cache, retrieve data from the cache
            $data = $cacheItem->get();
        }

        return $data;
    }
}
