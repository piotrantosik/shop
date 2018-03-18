<?php

namespace App\Tests\Controller\Shop;

use App\Domain\Query\Shop\Product\ProductQueryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertCount(
            ProductQueryInterface::DEFAULT_LIMIT * 2,
            $crawler->filter('table > tbody > tr')
        );
    }
}
