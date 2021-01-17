<?php


namespace App\Controller;

use App\Entity\Exploitation;
use App\Entity\Image;
use App\Form\ImageFormType;
use App\Repository\ExploitationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Accueil")
     * Page par défaut du site
     */
    public function home(ExploitationRepository $repository):Response
    {

        $exploitations = $repository->findAll();

        //Rendu du controller vers la page en html.twig
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'exploitations' => $exploitations,
        ]);
    }
}