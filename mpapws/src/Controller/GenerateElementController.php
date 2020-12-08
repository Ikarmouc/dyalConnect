<?php

namespace App\Controller;

use App\Entity\Producteurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenerateElementController extends AbstractController
{
    /**
     * @Route("/generate/producteur", name="generate_element")
     */
    public function generateProducteur(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $producteur = new Producteurs();
        $producteur->setExploitationId(1);
        $producteur->setNom("Pierre");
        $producteur->setPrenom("Jean");

        $entityManager->persist($producteur);
        $entityManager->flush();
        return new Response("Création d'un producteur");
    }
}