<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/product")
 */

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product")
     */
    public function index(): Response
    {
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);


    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
