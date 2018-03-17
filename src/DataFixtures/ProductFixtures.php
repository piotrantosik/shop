<?php

namespace App\DataFixtures;

use App\Domain\Command\Shop\Product\CreateNewProduct;
use App\Utils\Money as MoneyUtil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use League\Tactician\CommandBus;
use Money\Currency;
use Money\Money;

class ProductFixtures extends Fixture
{
    private $commandBus;
    private $money;

    public function __construct(CommandBus $commandBus, MoneyUtil $money)
    {
        $this->commandBus = $commandBus;
        $this->money = $money;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 55; $i++) {
            $command = new CreateNewProduct(
                'Product #' . $i,
                'Product description ' . $i,
                new Money(random_int(1000, 5000), new Currency($this->money->getCurrency()))
            );

            $this->commandBus->handle($command);
            //$manager->persist($product);
        }

        $manager->flush();
    }
}
