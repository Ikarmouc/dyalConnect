<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AjouterProduitController extends AbstractController
{
    /**
     * @Route("/exploitation/{id}/produits/nouveau", name="ajouter_produit")
     */
    public function index(Request $request, SluggerInterface $slugger, int $id, EntityManagerInterface $entityManager): Response
    {
        // On créer le produit
        $produit = new Produit();
        // On créer le formulaire que l'utilisateur devra remplir pour créer le produit
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        // Traitement quand le formulaire est valide et soumis
        if($form->isSubmitted() && $form->isValid())
        {
            // On récupère les données récupérer dans le formulaire
            $nom = $form->get("nom")->getData();
            $categorie = $form->get("categorie")->getData();
            $description = $form->get("description")->getData();
            $imageFile = $form->get("image")->getData();

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
                    print_r("fichier déplacé");
                }
                catch (FileException $e)
                {
                    print_r("MARHCE APSSSSSSSSSSSSSSSSSSSSSSSSS");
                }

                // Création d'une nouvelle image avec les données du formulaire
                $image = new Image();
                $image->setIdExploitation($id);
                $image->setImageName($newFilename);

                // Enregistrement de l'image dans la base de données
                $entityManager->persist($image);
                $entityManager->flush();

                // Création d'un nouveau produit avec les données du formulaire
                $produit->setNom($nom);
                $produit->setCategorie($categorie);
                $produit->setIdExploitation($id);
                $produit->setDescription($description);
                $produit->setMainImage($image->getId());

                // Enregistrement du produit dans la base de données
                $entityManager->persist($produit);
                $entityManager->flush();

                // Une fois le produit créer dans la base de données, ou redirige l'utilisateur vers la liste des produits de l'exploitation actuelle
                return $this->redirectToRoute("liste_produit", ["id" => $id]);

            }
        }

        return $this->render('ajouter_produit/index.html.twig', [
            'controller_name' => 'AjouterProduitController',
            "form" => $form->createView(),
        ]);
    }
}
