<?php

namespace App\Domain\Command\Shop\Product;

use Money\Currency;
use Money\Money;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class CreateNewProduct
{
    /**
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=100)
     */
    private $description;

    /**
     * @Assert\NotBlank()
     */
    private $price;

    public function __construct(?string $name, ?string $description, ?Money $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * @Assert\Callback()
     */
    public function validate(ExecutionContextInterface $context, $payload): void
    {
        if ($this->price && $this->price->lessThan(new Money(0, $this->price->getCurrency()))) {
            $context
                ->buildViolation('product.price.greater_than_or_equal')
                ->atPath('price')
                ->addViolation();
        }
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrice(): ?Money
    {
        return $this->price;
    }
}
