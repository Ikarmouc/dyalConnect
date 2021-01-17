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

    // Fonction permettant d'ajouter un élément dans une liste associative
    function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }

    /**
     * @Route("/exploitation/{id}/produits", name="liste_produit")
     */
    public function index(ProduitRepository $produitRepository, Exploitation $exploitation, ImageRepository $imageRepository)
    {
        //  Récupération des produits de l'exploitation actuelle dans un array
        $produits = $produitRepository->findBy(array("idExploitation" => $exploitation));

        // On créer l'array qui contiendera les images des produits
        $images = array();

        // On parcours les produits pour leurs assignées leurs images correspondante
        foreach ($produits as $produit)
        {
            // On verifie que le produit est lier à une image
            if($produit->getMainImage() != null)
            {
                // On récupère le nom de l'image
                $imageName = $imageRepository->find(array("id" => $produit->getMainImage()))->getImageName();
                // On associe le nom du produit avec le nom de l'image correspondante
                $images = $this->array_push_assoc($images, $produit->getNom(), $imageName);

            }
            // Sinon, on lui assigne un placeholder
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
