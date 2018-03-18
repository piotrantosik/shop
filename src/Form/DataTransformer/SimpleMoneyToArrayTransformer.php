<?php

namespace App\Form\DataTransformer;

use Money\Currency;
use Money\Money;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

class SimpleMoneyToArrayTransformer implements DataTransformerInterface
{
    private $currency;

    public function __construct(string $currency)
    {
        $this->currency = $currency;
    }

    public function transform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof Money) {
            throw new UnexpectedTypeException($value, 'Money');
        }

        return $value->getAmount();
    }

    public function reverseTransform($value)
    {
        if (null === $value) {
            return null;
        }

        return new Money($value, new Currency($this->currency));
    }
}
