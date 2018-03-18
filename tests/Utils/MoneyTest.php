<?php

namespace App\Tests\Utils;

use App\Utils\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testGetCurrency(): void
    {
        $money = new Money('pl');
        $this->assertEquals('PLN', $money->getCurrency());
    }
}
