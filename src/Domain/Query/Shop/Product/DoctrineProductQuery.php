<?php

namespace App\Domain\Query\Shop\Product;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class DoctrineProductQuery implements ProductQueryInterface
{
    private $paginator;
    private $entityManager;

    public function __construct(PaginatorInterface $paginator, EntityManagerInterface $entityManager)
    {
        $this->paginator = $paginator;
        $this->entityManager = $entityManager;
    }

    public function getPaginated(int $page, int $limit = self::DEFAULT_LIMIT): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->entityManager->getRepository(Product::class)
                ->createQueryBuilder('e')
                ->select('e')
                ->orderBy('e.id', 'desc')
                ->getQuery(),
            $page,
            $limit);
    }
}
