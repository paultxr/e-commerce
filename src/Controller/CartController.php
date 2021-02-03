<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_index")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository)
    {

        $cart = $session->get('cart', []);

        $cartWithData = [];

        foreach ($cart as $id => $quantity) {
            $cartWithData[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach ($cartWithData as $couple) {
            $total += $couple['product']->getPrice() * $couple['quantity'];
        }

        return $this->render('cart/index.html.twig', [
            "items" => $cartWithData,
            "total" => $total
        ]);
    }

    /**
     * @Route("/add/{id}", name="cart_add")
     */
    public function add($id, SessionInterface $session)
    {
        $cart = $session->get('cart', []);

        if (empty($cart[$id])) {
            $cart[$id] = 0;
        }

        $cart[$id]++;

        $session->set('cart', $cart);

        return $this->redirectToRoute("product");
    }

    /**
     * @Route("/delete/{id}", name="cart_remove")
     */
    public function remove($id, SessionInterface $session)
    {
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart_index');
    }

     /**
     * @Route("/success", name="success")
     */
    public function success() 
    {
        return $this->render('cart/success.html.twig');
    }


     /**
     * @Route("/error", name="error")
     */
    public function error() 
    {
        return $this->render('cart/error.html.twig');
    }

    /**
     * @Route("/create-checkout-session", name="checkout")
     */
    public function checkout(SessionInterface $session, ProductRepository $productRepository) 
    {
        $cart = $session->get('cart', []);
        
        $cartWithData = [];

        foreach ($cart as $id => $quantity) {
            $cartWithData[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity,
            ];
        }
        
        $total = 0;
        
        foreach ($cartWithData as $couple) {
            $total += $couple['product']->getPrice() * $couple['quantity'];
            \Stripe\Stripe::setApiKey('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');
        }

        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'usd',
                'unit_amount' => $total * 100,
                'product_data' => [
                  'name' => 'Total',
                ],
              ],
              'quantity' => $quantity,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('error', [], UrlGeneratorInterface::ABSOLUTE_URL),
          ]);

          return new JsonResponse(['id' => $checkoutSession->id]);
    }
}