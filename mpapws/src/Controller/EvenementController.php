<?php

namespace App\Controller;

use App\Entity\Exploitation;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/exploitation/{id}/evenements", name="evenement")
     */
    public function index(EvenementRepository $evenementRepository, Exploitation $exploitation): Response
    {
        $evenements = $evenementRepository->findBy(array("idProducteur" => $exploitation));

        return $this->render('evenement/index.html.twig', [
            'controller_name' => 'EvenementController',
            'evenements' => $evenements,
            'exploitation' => $exploitation,
        ]);
    }
}
