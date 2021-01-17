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
        // On créer l'évènement
        $evenement = new Evenement();
        // On créer le formulaire que l'utilisateur devra remplir pour créer l'évènement
        $form = $this->createForm(AjouterEvenement::class, $evenement);
        $form->handleRequest($request);

        // Traitement quand le formulaire est valide et soumis
        if($form->isSubmitted() && $form->isValid())
        {
            // On récupère les données récupérer dans le formulaire
            $nom = $form->get("nomEvt")->getData();
            $detail = $form->get("detailEvt")->getData();
            $date = $form->get("dateEvt")->getData();
            $horaire = $form->get("horaireEvt")->getData();
            $imageFile = $form->get("imageEvt")->getData();

            // On vérifie si l'image est conforme à nos attentes
            if($imageFile)
            {
                // On sauvegarde le nom de l'image
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // On ajoute un identifiant unique a la fin du nom de l'image
                $safeFilename = $slugger->slug($originalFilename);
                // On complète le nom final de l'image stocker en locale
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try
                {
                    // On sock l'image dans le dossier /public/images
                    $imageFile->move($this->getParameter("images_directory"), $newFilename);
                }
                catch (FileException $e)
                {
                    print_r("MARHCE PASSSSSSSSSSSSSSSSSSSSSSSSS");
                }

                // Création d'une nouvelle image avec les données du formulaire
                $image = new Image();
                $image->setIdExploitation($id);
                $image->setImageName($newFilename);

                // Enregistrement de l'image dans la base de données
                $entityManager->persist($image);
                $entityManager->flush();

                // Création d'un nouvelle évènement avec les données du formulaire
                $evenement->setNomEvt($nom);
                $evenement->setIdProducteur($id);
                $evenement->setDetailEvt($detail);
                $evenement->setImageEvt($image->getId());
                $evenement->setDateEvt($date);
                $evenement->setHoraireEvt($horaire);

                // Enregistrement du nouvelle évènement dans la base de données
                $entityManager->persist($evenement);
                $entityManager->flush();

                // Une fois le produit créer dans la base de données, ou redirige l'utilisateur vers la liste des produits de l'exploitation actuelle
                return $this->redirectToRoute("evenement", ["id" => $id]);

            }
        }

        return $this->render('ajouter_evenement/index.html.twig', [
            'controller_name' => 'AjouterEvenementController',
            "form" => $form->createView(),
        ]);
    }
}
