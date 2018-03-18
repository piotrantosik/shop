<?php

namespace App\Tests\Domain\Command\Shop\Product;

use App\Domain\Command\Shop\Product\CreateNewProduct;
use App\Domain\Command\Shop\Product\CreateNewProductHandler;
use App\Events;
use Doctrine\ORM\EntityManagerInterface;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class CreateNewProductHandlerTest extends TestCase
{
    public function testHandler(): void
    {
        $createNewProduct = new CreateNewProduct('name', 'description', new Money(100, new Currency('USD')));

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush');

        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $eventDispatcher->expects($this->once())
            ->method('dispatch')
            ->with(Events::PRODUCT_CREATED, $this->isInstanceOf(GenericEvent::class));

        $handler = new CreateNewProductHandler(
            $entityManager,
            $eventDispatcher
        );
        $handler->handle($createNewProduct);
    }
}
