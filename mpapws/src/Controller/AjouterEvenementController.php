<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Evenement;
use App\Form\AjouterEvenement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AjouterEvenementController extends AbstractController
{
    /**
     * @Route("/exploitation/{id}/evenements/nouveau", name="ajouter_evenement")
     */
    public function index(Request $request, SluggerInterface $slugger, int $id, EntityManagerInterface $entityManager): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(AjouterEvenement::class, $evenement);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $nom = $form->get("nomEvt")->getData();
            $detail = $form->get("detailEvt")->getData();
            $date = $form->get("dateEvt")->getData();
            $horaire = $form->get("horaireEvt")->getData();
            $imageFile = $form->get("imageEvt")->getData();

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

                $image = new Image();
                $image->setIdExploitation($id);
                $image->setImageName($newFilename);

                $entityManager->persist($image);
                $entityManager->flush();

                $evenement->setNomEvt($nom);
                $evenement->setIdProducteur($id);
                $evenement->setDetailEvt($detail);
                $evenement>setImageEvt($image->getId());
                $evenement->setDateEvt($date);
                $evenement->setHoraireEvt($horaire);

                $entityManager->persist($evenement);
                $entityManager->flush();

            }
        }

        return $this->render('ajouter_evenement/index.html.twig', [
            'controller_name' => 'AjouterEvenementController',
            "form" => $form->createView(),
        ]);
    }
}
