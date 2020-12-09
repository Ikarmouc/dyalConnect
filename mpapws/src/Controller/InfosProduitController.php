<?php

namespace App\Controller;

use App\Entity\Exploitation;
use App\Entity\Produit;
use App\Repository\ExploitationRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfosProduitController extends AbstractController
{
    /**
     * @Route("/exploitation/{idExploitation}/produits/{id}", name="infos_produit")
     */
    public function index(ProduitRepository $produitRepository, ExploitationRepository $exploitationRepository,int $id, int $idExploitation): Response
    {
        $produit = $produitRepository->find(array("id" => $id));
        $exploitation = $exploitationRepository->find(array("id" => $idExploitation));

        return $this->render('infos_produit/index.html.twig', [
            'controller_name' => 'InfosProduitController',
            'produit' => $produit,
            'exploitation' => $exploitation,
        ]);
    }
}
