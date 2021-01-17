<?php

namespace App\Controller;

use App\Entity\Exploitation;
use App\Repository\EvenementRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class EvenementController extends AbstractController
{

    // Fonction permettant d'ajouter un élément dans une liste associative
    function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }

    /**
     * @Route("/exploitation/{id}/evenements", name="evenement")
     * fonction permettant la récuperation des evenements dans une exploitation
     */

    public function index(ImageRepository $imageRepository,EvenementRepository $evenementRepository, Exploitation $exploitation): Response
    {

        $evenements = $evenementRepository->findBy(array("idProducteur" => $exploitation));

        $images = array();

        // On parcourt les images des evenements pour les afficher dans le site
        foreach ($evenements as $evenement)
        {
            if($evenement->getImageEvt() != null)
            {
                $imageName = $imageRepository->find(array("id" => $evenement->getImageEvt()))->getImageName();
                $images = $this->array_push_assoc($images, $evenement->getNomEvt(), $imageName);

            }
            else
            {
                $images = $this->array_push_assoc($images, $evenement->getNomEvt(), "Chevrex.jpg");
            }
        }


        return $this->render('evenement/index.html.twig', [
            'controller_name' => 'EvenementController',
            'evenements' => $evenements,
            'exploitation' => $exploitation,
            'images' => $images,
        ]);
    }
}
