<?php

namespace App\Controller\Admin;

use App\Form\ProductType;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/new-product", name="admin.products.new")
     */
    public function new(Request $request, CommandBus $commandBus)
    {
        $form = $this->createForm(ProductType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandBus->handle($form->getData());

            return $this->redirectToRoute('shop.products');
        }

        return $this->render('admin/product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
