<?php

namespace App\Controller;

use App\Entity\Exploitation;
use App\Repository\ImageRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeProduitController extends AbstractController
{

    function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }

    /**
     * @Route("/exploitation/{id}/produits", name="liste_produit")
     */
    public function index(ProduitRepository $produitRepository, Exploitation $exploitation, ImageRepository $imageRepository)
    {
        $produits = $produitRepository->findBy(array("idExploitation" => $exploitation));

        $images = array();

        foreach ($produits as $produit)
        {
            if($produit->getMainImage() != null)
            {
                $imageName = $imageRepository->find(array("id" => $produit->getMainImage()))->getImageName();
                $images = $this->array_push_assoc($images, $produit->getNom(), $imageName);
                
            }
            else
            {
                $images = $this->array_push_assoc($images, $produit->getNom(), "Chevrex.jpg");
            }
        }

        return $this->render('liste_produit/index.html.twig', [
            'controller_name' => 'ListeProduitController',
            'exploitation' => $exploitation,
            'produits' => $produits,
            "images" => $images,
        ]);
    }
}
