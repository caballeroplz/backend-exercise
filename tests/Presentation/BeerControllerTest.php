<?php

namespace App\Tests\Presentation;

use PHPUnit\Framework\TestCase;
use App\Presentation\Controller\BeerController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Application\Service\BeerService;
use App\Domain\Beer\Beer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BeerControllerTest extends TestCase
{
    public function testGetBeerById()
    {
        $beerServiceMock = $this->createMock(BeerService::class);
        $beerServiceMock->expects($this->once())
            ->method('getBeerById')
            ->willReturn(new Beer(1, 'Test Beer', 'Test Tagline', '03/2022', 'Test Description', 'test_image.jpg'));

        $controller = new BeerController($beerServiceMock);

        $request = Request::create('/findbyid/beer/1');
        $response = $controller->getBeerById(1, $request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);
        $this->assertEquals(1, $data['id']);
    }
    
    public function testSearchBeersByFood()
    {
        $beerServiceMock = $this->createMock(BeerService::class);
        $beerServiceMock->expects($this->once())
            ->method('searchBeersByFood')
            ->with('Pizza')
            ->willReturn([
                new Beer(1, 'Beer 1', 'Tagline 1', '01/2022', 'Description 1', 'image1.jpg'),
                new Beer(2, 'Beer 2', 'Tagline 2', '02/2022', 'Description 2', 'image2.jpg'),
            ]);
    
        $beerController = new BeerController($beerServiceMock);
    
        $request = Request::create('/beers/food/Pizza', 'GET');
    
        $response = $beerController->searchBeersByFood('Pizza');
    
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    
        $expectedContent = json_encode([
            [
                'id' => 1,
                'name' => 'Beer 1',
                'tagline' => 'Tagline 1',
                'firstBrewed' => '01/2022',
                'description' => 'Description 1',
                'imageUrl' => 'image1.jpg',
            ],
            [
                'id' => 2,
                'name' => 'Beer 2',
                'tagline' => 'Tagline 2',
                'firstBrewed' => '02/2022',
                'description' => 'Description 2',
                'imageUrl' => 'image2.jpg',
            ],
        ]);
    
        $this->assertEquals($expectedContent, $response->getContent());
    }
}
