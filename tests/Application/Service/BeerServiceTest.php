<?php

namespace App\Tests\Application\Service;

use PHPUnit\Framework\TestCase;
use App\Application\Service\BeerService;
use App\Domain\Beer\Beer;
use App\Infrastructure\Api\PunkApi;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class BeerServiceTest extends TestCase
{
    public function testGetBeerById()
    {
        $punkApiMock = $this->createMock(PunkApi::class);
        $punkApiMock->expects($this->once())
            ->method('getBeerById')
            ->willReturn([
                'id' => 1,
                'name' => 'Test Beer',
                'tagline' => 'Test Tagline',
                'first_brewed' => '03/2022',
                'description' => 'Test Description',
                'image_url' => 'test_image.jpg',
            ]);

        $cacheMock = $this->createMock(CacheInterface::class);
        $cacheMock->method('get')
            ->willReturnCallback(function ($key, $callback) {
                $itemMock = $this->createMock(ItemInterface::class);
                return $callback($itemMock);
            });

        $beerService = new BeerService($punkApiMock, $cacheMock);

        $beer = $beerService->getBeerById(1);

        $this->assertInstanceOf(Beer::class, $beer);
        $this->assertEquals(1, $beer->getId()->getValue());
    }
}
