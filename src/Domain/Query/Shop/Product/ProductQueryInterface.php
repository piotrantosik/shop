<?php

namespace App\Domain\Query\Shop\Product;

use Knp\Component\Pager\Pagination\PaginationInterface;

interface ProductQueryInterface
{
    public const DEFAULT_LIMIT = 10;

    public function getPaginated(int $page, int $limit = self::DEFAULT_LIMIT): PaginationInterface;
}
