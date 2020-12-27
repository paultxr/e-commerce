<?php

namespace App\Controller;

use App\Entity\Faq;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FaqController extends AbstractController
{
    /**
     * @Route("/faq", name="faq")
     */
    public function index(): Response
    {
        $faq = $this->getDoctrine()
        ->getRepository(Faq::class)
        ->findAll();
        return $this->render('faq/index.html.twig', [
            'faq' => $faq,
        ]);
    }
}
