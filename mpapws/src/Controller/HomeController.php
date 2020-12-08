<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Accueil")
     */

    public function home()
    {
        return $this->render('Exploitation/index.html.twig', [ 'controller_name' => 'HomeController']);
    }
}