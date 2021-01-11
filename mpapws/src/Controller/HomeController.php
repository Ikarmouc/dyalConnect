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
     */

    public function home(Request $request, SluggerInterface $slugger, ExploitationRepository $repository, EntityManagerInterface $entityManager) : Response
    {
        $image = new Image();
        $form = $this->createForm(ImageFormType::class, $image);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $imageFile = $form->get("image")->getData();

            if($imageFile)
            {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try
                {
                    $imageFile->move($this->getParameter("images_directory"), $newFilename);
                }
                catch (FileException $e)
                {
                    print_r("MARHCE APSSSSSSSSSSSSSSSSSSSSSSSSS");
                }

                $image->setIdExploitation(1);
                $image->setImageName($newFilename);
                $exploitation = $repository->find(array("id" => 1));

                $entityManager->persist($image);
                $entityManager->flush();

                $exploitation->setMainImage($image->getId());

                $entityManager->persist($exploitation);
                $entityManager->flush();

            }
        }

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView(),
        ]);
    }
}