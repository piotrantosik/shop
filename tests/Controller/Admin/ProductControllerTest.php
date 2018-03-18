<?php

namespace App\Tests\Controller\Admin;

use App\Domain\Query\Shop\Product\ProductQueryInterface;
use App\Entity\Product;
use Money\Currency;
use Money\Money;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ProductControllerTest extends WebTestCase
{
    public function testRedirectToLoginPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/new-product');
        $crawler = $client->followRedirect();
        $this->assertTrue($crawler->filter('html:contains("Zaloguj")')->count() > 0);
    }

    public function testLogin(): void
    {
        [$client, $crawler] = $this->login();

        $this->assertEquals(1, $crawler->filter('html:contains("Dodaj produkt")')->count());
    }

    public function testProductInvalidData(): void
    {
        $productName = 'Product test ' . mt_rand();
        $productDescription = 'Product description test';
        $productPrice = random_int(100, 2000);
        [$client, $crawler] = $this->login();

        $crawler = $client->request('GET', '/admin/new-product');
        $form = $crawler->selectButton('Dodaj produkt')->form([
            'product[name]' => $productName,
            'product[description]' => $productDescription,
            'product[price]' => $productPrice,
        ]);
        $crawler = $client->submit($form);
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('html:contains("Ta wartość jest zbyt krótka. Powinna mieć 100 lub więcej znaków.")')->count());
    }

    public function testAddProduct(): void
    {
        $productName = 'Product test ' . mt_rand();
        $productDescription = 'Product description test Product description test Product description test Product description test Product description test';
        $productPrice = random_int(100, 2000);
        [$client, $crawler] = $this->login();

        $crawler = $client->request('GET', '/admin/new-product');
        $form = $crawler->selectButton('Dodaj produkt')->form([
            'product[name]' => $productName,
            'product[description]' => $productDescription,
            'product[price]' => $productPrice,
        ]);
        $client->submit($form);
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $product = $client->getContainer()->get('doctrine')->getRepository(Product::class)->findOneBy([
            'name' => $productName,
        ]);
        $this->assertNotNull($product);
        $this->assertSame($productDescription, $product->getDescription());
        $this->assertEquals(new Money($productPrice * 100, new Currency('PLN')), $product->getPrice());
    }

    private function login(): array
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $crawler = $client->click($crawler->selectLink('Zaloguj')->link());

        $form = $crawler->selectButton('Zaloguj')->form([
            '_username' => 'user',
            '_password' => 'shop',
        ]);
        $client->followRedirects();
        $crawler = $client->submit($form);

        return [$client, $crawler];
    }
}
