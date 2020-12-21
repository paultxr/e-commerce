<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
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
}
