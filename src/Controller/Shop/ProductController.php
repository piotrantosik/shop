<?php

namespace App\Controller\Shop;

use App\Domain\Query\Shop\Product\ProductQueryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="shop.products")
     */
    public function index(Request $request,ProductQueryInterface $productQuery)
    {
        return $this->render('shop/index.html.twig', [
            'pagination' => $productQuery->getPaginated($request->query->getInt('page', 1), 10)
        ]);
    }
}
