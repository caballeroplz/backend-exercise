<?php

namespace App\Tests\Domain\Beer;

use PHPUnit\Framework\TestCase;
use App\Domain\Beer\Beer;

class BeerTest extends TestCase
{
    public function testCreateBeer()
    {
        $beer = new Beer(1, 'Test Beer', 'Test Tagline', '03/2022', 'Test Description', 'test_image.jpg');

        $this->assertEquals(1, $beer->getId()->getValue());
        $this->assertEquals('Test Beer', $beer->getName()->getValue());
        $this->assertEquals('Test Tagline', $beer->getTagline()->getValue());
        $this->assertEquals('03/2022', $beer->getFirstBrewed()->getValue());
        $this->assertEquals('Test Description', $beer->getDescription()->getValue());
        $this->assertEquals('test_image.jpg', $beer->getImageUrl()->getValue());
    }
}
