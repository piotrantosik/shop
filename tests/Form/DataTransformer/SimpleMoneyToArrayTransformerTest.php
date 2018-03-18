<?php

namespace App\Form\DataTransformer;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

class SimpleMoneyToArrayTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $simpleMoneyToArrayTransformer = new SimpleMoneyToArrayTransformer('USD');
        $this->assertEquals(100, $simpleMoneyToArrayTransformer->transform(new Money(100, new Currency('USD'))));
    }

    public function testExceptionTransform(): void
    {
        $simpleMoneyToArrayTransformer = new SimpleMoneyToArrayTransformer('USD');
        $this->expectException(UnexpectedTypeException::class);
        $simpleMoneyToArrayTransformer->transform('not_money');
    }

    public function testReverseTransform(): void
    {
        $simpleMoneyToArrayTransformer = new SimpleMoneyToArrayTransformer('USD');
        $this->assertEquals(null, $simpleMoneyToArrayTransformer->reverseTransform(null));
        $this->assertEquals(new Money(100, new Currency('USD')), $simpleMoneyToArrayTransformer->reverseTransform(100));
    }
}
