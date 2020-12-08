<?php

namespace App\Controller;

use App\Entity\Exploitation;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeProduitController extends AbstractController
{
    /**
     * @Route("/exploitation/{id}/produits", name="liste_produit")
     */
    public function index(ProduitRepository $produitRepository, Exploitation $exploitation)
    {
        $produits = $produitRepository->findBy(array("idExploitation" => $exploitation));

        return $this->render('liste_produit/index.html.twig', [
            'controller_name' => 'ListeProduitController',
            'exploitation' => $exploitation,
            'produits' => $produits,
        ]);
    }
}
