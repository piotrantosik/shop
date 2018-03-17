<?php

namespace App\Domain\Command\Shop\Product;

use Money\Money;
use Symfony\Component\Validator\Constraints as Assert;

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
