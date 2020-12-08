<?php

namespace App\Controller;

use App\Entity\Exploitation;
use App\Entity\Producteurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;

class GenerateElementController extends AbstractController
{
    /**
     * @Route("/generate/producteur", name="generate_element")
     */
    public function generateProducteur(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $producteurs = new Producteurs();
        $producteurs->setExploitationId(1);
        $producteurs->setNom("Pierre");
        $producteurs->setPrenom("Jean-Marie");

        $entityManager->persist($producteurs);



        $exploitation = new Exploitation();
        $exploitation->setNom("La Prod de Jean-Mi");
        $exploitation->setAdresse("4 rue test 29000 brest");
        $exploitation->setIdExploitant(1);
        $exploitation->setDetails("ICI C'est les details de l'exploitation")

        $entityManager->persist($exploitation);
        $entityManager->flush();


        return new Response("Création d'un producteur");
    }
}
