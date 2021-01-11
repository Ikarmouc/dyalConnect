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
     * @Route("/exploitation/{id}/produit/nouveau", name="ajouter_produit")
     */
    public function index(Request $request, SluggerInterface $slugger, int $id, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $nom = $form->get("nom")->getData();
            $description = $form->get("description")->getData();
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

                $image = new Image();
                $image->setIdExploitation($id);
                $image->setImageName($newFilename);

                $entityManager->persist($image);
                $entityManager->flush();

                $produit->setNom($nom);
                $produit->setIdExploitation($id);
                $produit->setDescription($description);
                $produit->setMainImage($image->getId());

                $entityManager->persist($produit);
                $entityManager->flush();

            }
        }

        return $this->render('ajouter_produit/index.html.twig', [
            'controller_name' => 'AjouterProduitController',
            "form" => $form->createView(),
        ]);
    }
}
