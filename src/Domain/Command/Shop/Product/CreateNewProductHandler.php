<?php

namespace App\Domain\Command\Shop\Product;

use App\Entity\Product;
use App\Events;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class CreateNewProductHandler
{
    private $entityManager;
    private $eventDispatcher;

    public function __construct(EntityManagerInterface $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(CreateNewProduct $command)
    {
        $product = new Product(
            $command->getName(),
            $command->getDescription(),
            $command->getPrice()
        );

        $this->entityManager->persist($product);
        $this->entityManager->flush($product);

        $this->eventDispatcher->dispatch(Events::PRODUCT_CREATED, new GenericEvent($product));
    }
}
