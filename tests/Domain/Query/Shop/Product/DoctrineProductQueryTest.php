<?php

namespace App\Tests\Domain\Query\Shop\Product;

use App\Domain\Query\Shop\Product\DoctrineProductQuery;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctrineProductQueryTest extends WebTestCase
{
    private $entityManager;
    private $paginator;

    protected function setUp()
    {
        //prepare empty database
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->paginator = $kernel->getContainer()->get('knp_paginator');
    }

    public function testGetPaginated(): void
    {
        $doctrineProductQuery = new DoctrineProductQuery($this->paginator, $this->entityManager);
        $pagination = $doctrineProductQuery->getPaginated(1);
        $this->assertInstanceOf(PaginationInterface::class, $pagination);

    }
}
