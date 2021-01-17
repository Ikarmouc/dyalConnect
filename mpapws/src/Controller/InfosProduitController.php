<?php

namespace App\Controller;

use App\Entity\Exploitation;
use App\Entity\Produit;
use App\Repository\ExploitationRepository;
use App\Repository\ImageRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfosProduitController extends AbstractController
{
    /**
     * @Route("/exploitation/{idExploitation}/produits/{id}", name="infos_produit")
     */
    public function index(ProduitRepository $produitRepository, ImageRepository $imageRepository,ExploitationRepository $exploitationRepository,int $id, int $idExploitation): Response
    {
        // Récupération du produit sélectionner
        $produit = $produitRepository->find(array("id" => $id));
        // Récupération de l'exploitation pour laquelle le produit appartient
        $exploitation = $exploitationRepository->find(array("id" => $idExploitation));

        // On assigne le placeholder par défaut
        $image = "Chevrex.jpg";

        // On vérifie si le produit à une image assigné
        if($produit->getMainImage() != null)
        {
            $image = $imageRepository->find(array("id" => $produit->getMainImage()))->getImageName();
        }

        return $this->render('infos_produit/index.html.twig', [
            'controller_name' => 'InfosProduitController',
            'produit' => $produit,
            'exploitation' => $exploitation,
            'image' => $image,
        ]);
    }
}
