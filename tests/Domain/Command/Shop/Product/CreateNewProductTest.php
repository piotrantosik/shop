<?php

namespace App\Tests\Domain\Command\Shop\Product;

use App\Domain\Command\Shop\Product\CreateNewProduct;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

class CreateNewProductTest extends TestCase
{
    public function testCreateNewProduct(): void
    {
        $createNewProduct = new CreateNewProduct('name', 'description', new Money(100, new Currency('USD')));

        $this->assertEquals('name', $createNewProduct->getName());
        $this->assertEquals('description', $createNewProduct->getDescription());
        $this->assertEquals(new Money(100, new Currency('USD')), $createNewProduct->getPrice());
    }
}
