<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfosProduitController extends AbstractController
{
    /**
     * @Route("/exploitation/{idExploitation}/produits/{id}", name="infos_produit")
     */
    public function index(): Response
    {
        return $this->render('infos_produit/index.html.twig', [
            'controller_name' => 'InfosProduitController',
        ]);
    }
}
